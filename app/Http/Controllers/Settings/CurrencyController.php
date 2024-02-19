<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('currency-list')) {
            $data = Currency::orderBy('id','DESC')->paginate(5);
            return view('settings.currency.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }else{
            return view('auth-404-basic');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::getAllCurrencies();
        return view('settings.currency.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:m_currencies,code',
            'symbol' => 'required',
            'name' => 'required|unique:m_currencies,name',
        ]); 

        $params = $request->all();
        $params['is_default'] = $request->has('is_default');
        
        if($params['is_default'] == 1){
            $latestDefaultCurrency = Currency::where('is_default', 1)->latest()->first();
            if ($latestDefaultCurrency) {
                $latestDefaultCurrency->update(['is_default' => 0]);
            }
        }

        Currency::create($params);

        return redirect()->route('settings.currency.index')->with('success','Currency created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $currency = Currency::find($id);
        // return view('settings.currency.show',compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $currency = Currency::find($id);
        $currencies = Currency::getAllCurrencies();
        return view('settings.currency.edit',compact('currency','currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:m_currencies,code,'.$id,
            'symbol' => 'required',
            'name' => 'required|unique:m_currencies,name,'.$id,
        ]); 

        $input = $request->all();
        $input['is_default'] = $request->has('is_default');
        
        if($input['is_default'] == 1){
            $latestDefaultCurrency = Currency::where('is_default', 1)->latest()->first();
            if ($latestDefaultCurrency) {
                $latestDefaultCurrency->update(['is_default' => 0]);
            }
        }

        $currency = Currency::find($id);
        $currency->update($input);

        return redirect()->route('settings.currency.index')
                    ->with('success','Currency details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Currency::find($id)->delete();
        return redirect()->route('settings.currency.index')
            ->with('success','Currency deleted successfully');
    }
    
}

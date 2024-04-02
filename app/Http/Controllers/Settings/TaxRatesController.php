<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRates;
use App\Models\TaxRatesDefault;
use Illuminate\Support\Facades\Auth;

class TaxRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('taxrates-list')) {
            $data = TaxRates::orderBy('id','DESC')->paginate(50000);
            return view('settings.taxrates.index',compact('data'))
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
        return view('settings.taxrates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tax_name' => 'required',
            'tax_type' => 'required',
            'tax_rate_percentage' => 'required|numeric',
        ]); 

        $params = $request->all();
        TaxRates::create($params);

        return redirect()->route('settings.taxrates.index')->with('success','TaxRates created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $taxrates = TaxRates::find($id);
        // return view('settings.taxrates.show',compact('taxrates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taxrates = TaxRates::find($id);
        return view('settings.taxrates.edit',compact('taxrates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tax_name' => 'required',
            'tax_type' => 'required',
            'tax_rate_percentage' => 'required|numeric',
        ]);

        $input = $request->all();

        $taxrates = TaxRates::find($id);
        $taxrates->update($input);

        return redirect()->route('settings.taxrates.index')
                    ->with('success','TaxRates details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        TaxRates::find($id)->delete();
        return redirect()->route('settings.taxrates.index')
            ->with('success','TaxRates deleted successfully');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use App\Models\TaxRates;
use Illuminate\Http\Request;
use App\Models\TaxRatesDefault;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('product-list')) {

            $query = Product::query();

            if ($request->filled('sp_min')) {
                $query->where('selling_price', '>=', $request->input('sp_min'));
            }
            if ($request->filled('sp_max')) {
                $query->where('selling_price', '<=', $request->input('sp_max'));
            }    
            if ($request->filled('pp_min')) {
                $query->where('purchase_account', '>=', $request->input('pp_min'));
            }
            if ($request->filled('pp_max')) {
                $query->where('purchase_account', '<=', $request->input('pp_max'));
            }

            $data = $query->orderBy('id', 'DESC')->paginate(500000);

            return view('product.index',compact('data'))
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
        $taxrates = TaxRates::select('id','tax_name','tax_rate_percentage')->get();
        $taxrates_default = TaxRatesDefault::find(1) ?? NULL;
        $default_currency = Currency::GetBaseCurrency()->first();

        return view('product.create', compact('taxrates','taxrates_default','default_currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'tax_preference' => 'required',
            'intra_tax_rate_id' => 'required_if:tax_preference,Taxable',
            'inter_tax_rate_id' => 'required_if:tax_preference,Taxable',
            'selling_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
         ]);

        $params = $request->all();
        $params['track_inventry'] = $request->has('track_inventry');

        Product::create($params);

        return redirect()->route('product.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $taxrates = TaxRates::select('id','tax_name','tax_rate_percentage')->get();
        $taxrates_default = TaxRatesDefault::find(1) ?? NULL;
        $default_currency = Currency::GetBaseCurrency()->first();

        return view('product.edit',compact('product','taxrates','taxrates_default','default_currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'tax_preference' => 'required',
            'intra_tax_rate_id' => 'required_if:tax_preference,Taxable',
            'inter_tax_rate_id' => 'required_if:tax_preference,Taxable',
            'selling_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
         ]);

        $input = $request->all();
        $input['track_inventry'] = $request->has('track_inventry');

        $product = Product::find($id);
        $product->update($input);

        return redirect()->route('product.index')
                    ->with('success','Product details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Product::find($id)->delete();
        return redirect()->route('product.index')
            ->with('success','Product deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use App\Models\GST_Treatment;
use App\Models\PlaceOfSupply;
use Illuminate\Support\Facades\Auth;


class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('purchaseorder-list')) {
            $data = PurchaseOrder::orderBy('id','DESC')->paginate(5000000);

            return view('purchaseorder.index',compact('data'))
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
        $customers = Customer::select('id','company_name')->get();
        $nextsaleordernum = PurchaseOrder::getSaleOrderNumber();
        $products = Product::select('id','name')->get();

        $tax_pref = Product::getTaxPreferenceEnumValues();
        $tax_pref = array_diff($tax_pref, ['Taxable']);
        $pos = PlaceOfSupply::select('id','short_code','name','intra_state')->get();
        

        return view('purchaseorder.create',compact('customers','nextsaleordernum','products','tax_pref','pos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $this->validate($request, [
            'customer_id' => 'required',
            'sale_order_id' => 'required|unique:purchaseorders,sale_order_id',
            'reference_num' => 'nullable',
            'saleorder_date' => 'required',
            'place_of_supply' => 'required',
            'total_amount' => 'required',
        ]);


        $params['saleorder_date'] =  Carbon::createFromFormat('d-m-Y', $params['saleorder_date'])->format('Y-m-d');
        $params['order_status'] = 'Created';

        PurchaseOrder::create($params);

        return redirect()->route('orders.index')->with('success','PurchaseOrder created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = PurchaseOrder::find($id);
        return view('purchaseorder.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $saleorder = PurchaseOrder::find($id);

        $customers = Customer::select('id','company_name')->get();
        $nextsaleordernum = PurchaseOrder::getSaleOrderNumber();
        $products = Product::select('id','name')->get();

        $tax_pref = Product::getTaxPreferenceEnumValues();
        $tax_pref = array_diff($tax_pref, ['Taxable']);
        $pos = PlaceOfSupply::select('id','short_code','name','intra_state')->get();
        
        return view('purchaseorder.edit',compact('saleorder','customers','nextsaleordernum','products','tax_pref','pos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:purchaseorders,email,'.$id,
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        $input = $request->all();
        
        $user = PurchaseOrder::find($id);
        $user->update($input);

        return redirect()->route('purchaseorder.index')
                    ->with('success','PurchaseOrder details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PurchaseOrder::find($id)->delete();

        return redirect()->route('purchaseorder.index')
                    ->with('success','PurchaseOrder deleted successfully');
    }
}

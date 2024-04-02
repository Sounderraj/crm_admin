<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\GST_Treatment;
use App\Models\PlaceOfSupply;
use Illuminate\Support\Facades\Auth;


class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('salesorder-list')) {
            $data = SalesOrder::orderBy('id','DESC')->paginate(5000000);

            return view('salesorder.index',compact('data'))
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
        $nextsaleordernum = SalesOrder::getSaleOrderNumber();
        $products = Product::select('id','name')->get();

        $tax_pref = Product::getTaxPreferenceEnumValues();
        // $tax_pref = array_diff($tax_pref, ['Taxable']);
        $pos = PlaceOfSupply::select('id','short_code','name','type')->get();

        return view('salesorder.create', compact('customers','nextsaleordernum','products','tax_pref','pos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $this->validate($request, [
            'customer_id' => 'required',
            'sale_order_id' => 'required|unique:salesorders,sale_order_id',
            'reference_num' => 'nullable',
            'saleorder_date' => 'required',
            'place_of_supply' => 'required',
            'total_amount' => 'required',
        ]);


        $params['saleorder_date'] =  Carbon::createFromFormat('d-m-Y', $params['saleorder_date'])->format('Y-m-d');
        $params['order_status'] = 'Created';

        SalesOrder::create($params);

        return redirect()->route('orders.index')->with('success','SalesOrder created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = SalesOrder::find($id);
        return view('salesorder.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $saleorder = SalesOrder::find($id);

        $customers = Customer::select('id','company_name')->get();
        $nextsaleordernum = SalesOrder::getSaleOrderNumber();
        $products = Product::select('id','name')->get();

        $tax_pref = Product::getTaxPreferenceEnumValues();
        $tax_pref = array_diff($tax_pref, ['Taxable']);
        $pos = PlaceOfSupply::select('id','short_code','name','type')->get();
        
        return view('salesorder.edit',compact('saleorder','customers','nextsaleordernum','products','tax_pref','pos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:salesorders,email,'.$id,
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        $input = $request->all();
        
        $user = SalesOrder::find($id);
        $user->update($input);

        return redirect()->route('salesorder.index')
                    ->with('success','SalesOrder details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SalesOrder::find($id)->delete();

        return redirect()->route('salesorder.index')
                    ->with('success','SalesOrder deleted successfully');
    }
}

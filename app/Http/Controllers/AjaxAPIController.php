<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Currency;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\GST_Treatment;
use Illuminate\Support\Facades\Auth;


class AjaxAPIController extends Controller
{

    public function getProductDetails(Request $request)
    {

        // Get the product ID from the request
        $productId = $request->input('id');

        // Fetch the product from the database
        $product = Product::select("name",
                                "type",
                                "unit",
                                "sku_number",
                                "hsn_code",
                                "sac_code",
                                "tax_preference",
                                "currency",
                                "selling_price",
                                "cost_price",
                                "intra_tax_rate_id",
                                "inter_tax_rate_id"
                            )
                            ->find($productId);

        // Check if the product exists
        if ($product) {
            // Return the rate of the product as a JSON response
            return response()->json($product->toArray());
        } else {
            // Return an error response if the product does not exist
            return response()->json(['error' => 'Product not found'], 404);
        }
    }


    // public function index(Request $request)
    // {
    //     if (Auth::user()->can('customer-list')) {
    //         $data = Customer::orderBy('id','DESC')->paginate(5);
    //         return view('customer.index',compact('data'))
    //             ->with('i', ($request->input('page', 1) - 1) * 5);
    //     }else{
    //         return view('auth-404-basic');
    //     }

    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gst_treatment = GST_Treatment::active()->get();
        $currency = Currency::active()->get();
        
        return view('customer.create',compact('gst_treatment','currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        Customer::create($params);

        return redirect()->route('customer.index')->with('success','Customer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Customer::find($id);
        return view('customer.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Customer::find($id);
        $gst_treatment = GST_Treatment::active()->get();
        $currency = Currency::active()->get();

        return view('customer.edit',compact('user','gst_treatment','currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$id,
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        $input = $request->all();
        
        $user = Customer::find($id);
        $user->update($input);

        return redirect()->route('customer.index')
                    ->with('success','Customer details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Customer::find($id)->delete();

        return redirect()->route('customer.index')
                    ->with('success','Customer deleted successfully');
    }
}

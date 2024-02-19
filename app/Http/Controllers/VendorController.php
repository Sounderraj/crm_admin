<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use App\Models\GST_Treatment;
use App\Models\Currency;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('vendors-list')) {
            $data = Vendor::orderBy('id','DESC')->paginate(5);
            return view('vendors.index',compact('data'))
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
        $gst_treatment = GST_Treatment::active()->get();
        $currency = Currency::active()->get();
        
        return view('vendors.create',compact('gst_treatment','currency'));
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
            'email' => 'required|email|unique:vendors,email',
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        Vendor::create($params);

        return redirect()->route('vendors.index')->with('success','Vendor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Vendor::find($id);
        return view('vendors.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Vendor::find($id);
        $gst_treatment = GST_Treatment::active()->get();
        $currency = Currency::active()->get();

        return view('vendors.edit',compact('user','gst_treatment','currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:vendors,email,'.$id,
            'company_name' => 'required',
            'mobile' => 'required',
        ]);

        $input = $request->all();
        
        $user = Vendor::find($id);
        $user->update($input);

        return redirect()->route('vendors.index')
                    ->with('success','Vendor details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Vendor::find($id)->delete();

        return redirect()->route('vendors.index')
                    ->with('success','Vendor deleted successfully');
    }
}

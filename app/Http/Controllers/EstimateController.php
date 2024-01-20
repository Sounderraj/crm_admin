<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('estimate-list')) {
            $data = Estimate::orderBy('id','DESC')->paginate(5);
            return view('estimate.index',compact('data'))
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
        // Fetch all customers
        $customers = Customer::all();
        $statusValues = Estimate::getStatusEnumValues();

        return view('estimate.create', compact('customers','statusValues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        unset($params['_token']);

        Estimate::create($params);

        return redirect()->route('estimate.index')->with('success','Estimate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estimate = Estimate::find($id);
        return view('estimate.show',compact('estimate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $estimate = Estimate::find($id);
        $customers = Customer::all();
        $statusValues = Estimate::getStatusEnumValues();

        return view('estimate.edit',compact('estimate','customers','statusValues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'quote_date' => 'required',
            'customer_id' => 'required',
            'reference_number' => 'required',
            'subject_name' => 'required',
            'rate' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();

        $user = Estimate::find($id);
        $user->update($input);

        return redirect()->route('estimate.index')
                    ->with('success','Estimate details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Estimate::find($id)->delete();

        return redirect()->route('estimate.index')
                    ->with('success','Estimate deleted successfully');
    }

}

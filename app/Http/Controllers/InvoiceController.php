<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Estimate;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('invoice-list')) {
            // $data = Estimate::orderBy('id','DESC')->paginate(5);
            $data = [];
            return view('invoice.index',compact('data'))
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
        return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        unset($params['_token']);

        Estimate::create($params);

        return redirect()->route('invoice.index')->with('success','Estimate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Estimate::find($id);
        return view('invoice.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Estimate::find($id);

        return view('invoice.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:invoices,email,'.$id,
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $input = $request->all();

        $user = Estimate::find($id);
        $user->update($input);

        return redirect()->route('invoice.index')
                    ->with('success','Estimate details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Estimate::find($id)->delete();

        return redirect()->route('invoice.index')
                    ->with('success','Estimate deleted successfully');
    }
}

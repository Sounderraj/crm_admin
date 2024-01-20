<?php

namespace App\Http\Controllers;

// use App\Models\Customer;
use App\Models\Leads;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('leads-list')) {
            $data = Leads::orderBy('id','DESC')->paginate(5);
            return view('leads.index',compact('data'))
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
        $statusValues = Leads::getLeadStatusEnumValues();

        return view('leads.create', compact('customers','statusValues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        unset($params['_token']);

        Leads::create($params);

        return redirect()->route('leads.index')->with('success','Estimate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leads = Leads::find($id);
        return view('leads.show',compact('leads'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leads = Leads::find($id);
        $customers = Customer::all();
        $statusValues = Leads::getLeadStatusEnumValues();

        return view('leads.edit',compact('leads','customers','statusValues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'location' => '',
            'leads_owner' => 'required',
            'leads_status' => 'required',
            'leads_score' => 'required',
        ]);

        $input = $request->all();

        $user = Leads::find($id);
        $user->update($input);

        return redirect()->route('leads.index')
                    ->with('success','Estimate details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Leads::find($id)->delete();

        return redirect()->route('leads.index')
                    ->with('success','Estimate deleted successfully');
    }

}

<?php

namespace App\Http\Controllers\Settings;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return redirect()->route('settings.organization.edit', 1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organization = Organization::findOrFail($id);
        return view('settings.organization.edit',compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'org_name' => 'required|string',
            'industry' => 'required|string',
            'GSTIN' => 'required_if:gst_registered,true',
        ]); 

        $input = $request->all();
        $input['gst_registered'] = $request->has('gst_registered');
        $input['gst_registered'] = $input['gst_registered'] ? '1':'0';

        $organization = Organization::find($id);
        $organization->update($input);

        return redirect()->back()->with('success','Organization details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
    
}

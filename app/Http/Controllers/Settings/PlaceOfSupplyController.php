<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlaceOfSupply;
use Illuminate\Support\Facades\Auth;

class PlaceOfSupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('placeofsupply-list')) {
            $data = PlaceOfSupply::orderBy('id','DESC')->paginate(5);
            return view('settings.placeofsupply.index',compact('data'))
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
        return view('settings.placeofsupply.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'short_code' => 'required|unique:m_place_of_supply,short_code',
            'name' => 'required|unique:m_place_of_supply,name',
            'type' => 'required',
        ]); 

        $params = $request->all();

        PlaceOfSupply::create($params);

        return redirect()->route('settings.placeofsupply.index')->with('success','PlaceOfSupply created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $placeofsupply = PlaceOfSupply::find($id);
        // return view('settings.placeofsupply.show',compact('placeofsupply'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $placeofsupply = PlaceOfSupply::find($id);
        return view('settings.placeofsupply.edit',compact('placeofsupply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'short_code' => 'required|unique:m_place_of_supply,short_code,'.$id,
            'name' => 'required|unique:m_place_of_supply,name,'.$id,
            'type' => 'required'
        ]); 

        $input = $request->all();

        $placeofsupply = PlaceOfSupply::find($id);
        $placeofsupply->update($input);

        return redirect()->route('settings.placeofsupply.index')
                    ->with('success','PlaceOfSupply details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PlaceOfSupply::find($id)->delete();
        return redirect()->route('settings.placeofsupply.index')
            ->with('success','PlaceOfSupply deleted successfully');
    }
    
}

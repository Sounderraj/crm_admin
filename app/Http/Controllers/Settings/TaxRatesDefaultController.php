<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRates;
use App\Models\TaxRatesDefault;

class TaxRatesDefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('settings.taxrates.create');
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
        // $taxrates = TaxRates::find($id);
        // return view('settings.taxrates.show',compact('taxrates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taxrates_default = TaxRatesDefault::find($id);
        $taxrates = TaxRates::select('id','tax_name','tax_rate_percentage')->get();

        return view('settings.taxrates_default.edit',compact('taxrates_default','taxrates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'intra_tax_rate_id' => 'required',
            'inter_tax_rate_id' => 'required',
        ]);

        $input = $request->all();

        $taxrates = TaxRatesDefault::find($id);
        if($taxrates){
            $taxrates->update($input);
        }else{
            TaxRatesDefault::create($input);
        }

        return redirect()->route('settings.taxrates.index')
                    ->with('success','Default Tax Preference details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
    
}

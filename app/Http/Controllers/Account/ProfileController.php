<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfileController extends Controller
{

    public function index(Request $request)
    {
        // if (Auth::user()->can('profile-list')) {

        //     $data = Auth::user()->id;

        //     return view('profile.index',compact('data'));
        // }else{
        //     return view('auth-404-basic');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->can('profile-show')) {

            $data = Auth::user()->id;

            return view('profile.show',compact('data'));
        }else{
            return view('auth-404-basic');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->can('profile-edit')) {

            $data = Auth::user()->id;

            return view('profile.edit',compact('data'));
        }else{
            return view('auth-404-basic');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ( ! Auth::user()->can('profile-edit')) {
            return view('auth-404-basic');
        }

        $this->validate($request, [
            'name'          => 'required',
            'mobile'        => 'required',
            'email'         => 'required|email|unique:users,email,'.$id,
            'description'   => 'nullable',
            'mobile'        => 'required',
        ]);

        $input = $request->all();
        
        $user = User::find($id);
        $user->update($input);

        return redirect()->back()->with('success','Account details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        User::find($id)->delete();

        return redirect()->route('profile.index')
                    ->with('success','Customer deleted successfully');
    }
}

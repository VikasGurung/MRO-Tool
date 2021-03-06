<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $users = User::all();
        return view('managers.index', [
            'users'=>$users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'fki_role_id' => 2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now() 
        ]);

        return redirect()->route('managers.index')
            ->with('success', 'User added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {   
        $user = User::find($user_id);
        return view('managers.edit', [
            'user' => $user
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        if($request->_token){
            $user = User::find($request->pki_user_id);
            if($request->name){
                $user->name = $request->name;
            }
            if($request->username){
                $user->email = $request->username;
            }
            $user->save();
            
            return redirect()->route('managers.edit', $user->pki_user_id)
            ->with('success', 'User updated successfully');
            
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        User::updateUser($request->pki_user_id, [
            'active' => 0
        ]);
        return redirect()->route('managers.index')
            ->with('success', 'User removed successfully');
    }
}

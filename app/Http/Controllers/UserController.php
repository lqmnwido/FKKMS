<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $role = Auth::user()->User_type;

        if ($role == 'Admin') {
            return view('manage_user.userList', compact('users'));

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Auth::user()->User_type;

        if ($role == 'Admin') {
            return view('manage_user.userCreate');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'MatricID' => $request['MatricID'],
            'company' => $request['company'],
            'User_type' => $request['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $users)
    {
        $user = User::find($users);
        return view('manage_user.userShow', ['user' => $user], compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $users)
    {
        $user = User::find($users);
        return view('manage_user.userEdit', ['user' => $user], compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $users)
    {

        if ($request['role'] != 'FK Student') {
            $matricID = null;
        } else {
            $matricID = $request['MatricID'];
        }

        if ($request['role'] != 'Vendor') {
            $company = null;
        } else {
            $company = $request['company'];
        }

        User::where('id', $users)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'MatricID' => $matricID,
            'company' => $company,
            'phone' => $request['phone'],
            'User_type' => $request['role'],
        ]);


        return redirect()->route('users.index')->with('success', 'User Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $users)
    {
        $user = User::findOrFail($users);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted!');
    }
}

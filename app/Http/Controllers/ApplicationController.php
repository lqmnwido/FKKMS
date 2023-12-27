<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = Application::all();

        $role=Auth::user()->User_type;
        
        $uRole=$request->role;

        if($role=='Admin')
        {
            return view('manage_application.applicationList', compact('applications'));   
        }else{
            return view('manage_application.addDetails', compact('applications','uRole'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appID = rand(10000, 99999);
        $applicationID =  'APP'.$appID;

        $existingApplication = Application::where([
            'User_ID' => $request['uid'],
            'Product_name' => $request['product'],
            'User_type' => $request['role'],
        ])->first();

        if($request['role']=='FK Student'){
            Application::create([
                'application_ID' => $applicationID,
                'User_ID' => $request['uid'],
                'name' => $request['name'],
                'MatricID' => $request['stdID'],
                'Product_name' => $request['product'],
                'Price' => $request['price'],
                'User_type' => $request['role'],
            ]);
        }

        if($request['role']=='Vendor'){
            Application::create([
                'application_ID' => $applicationID,
                'User_ID' => $request['uid'],
                'name' => $request['name'],
                'MatricID' => null,
                'Product_name' => $request['product'],
                'Price' => $request['price'],
                'User_type' => $request['role'],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Application sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

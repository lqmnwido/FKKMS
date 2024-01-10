<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $uRole=$request->role;

        $applications = Application::where('User_type', $uRole)->get();

        $role=Auth::user()->User_type;
        

        if($uRole== "Vendor" || $uRole== "FK Student"){
            $users = User::where('User_type', auth()->user()->$uRole)->get();
        }else{
            $users = User::all();
        }
        

        if($role=='Admin')
        {
            
            return view('manage_application.applicationList', compact('applications','uRole', 'users'));   
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

        User::where('User_ID', $request['uid'])->update([
            'phone' => $request['phone'],
        ]);


        return redirect()->route('dashboard')->with('success', 'Application sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = Application::where('User_ID', $id)->first();

        if ($users) {
            $role = $users->User_type; 
        }else{
            $role = null;
        }
        return view('manage_application.viewApplication', ['user' => $users], compact('users', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $users)
    {
        $application = Application::where('User_ID', $users)->first();
        $user = User::where('User_ID', $users)->first();
        if ($application) {
            $role = $application->User_type; 
        }else{
            $role = null;
        }
        return view('manage_application.updateDetails', ['id' => $users], compact('user', 'application','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        if ($request['role'] != 'FK Student') {
            $matricID = null;
        } else {
            $matricID = $request['stdID'];
        }

        if ($request['role'] != 'Vendor') {
            $company = null;
        } else {
            $company = $request['company'];
        }


        User::where('User_ID', $id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'MatricID' => $matricID,
            'company' => $company,
            'phone' => $request['phone'],
        ]);

        Application::where('User_ID', $id)->update([
            'name' => $request['name'],
            'Product_name' => $request['product'],
            'MatricID' => $matricID,
            'Price' => $request['price'],
        ]);

        
        return redirect()->route('view_application', ['id' => $id])->with('success', 'Application Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $users)
    {
        $users = Application::findOrFail($users);
        $users->delete();
        return redirect()->route('dashboard')->with('Alert', 'Application Deleted!');
    }

    //Admin
    public function approve(Request $request)
    {
        $ranID = rand(10000, 99999);
        $kioskID =  'KIOSK'.$ranID;

        $application_ID = $request['id'];
        $status = 'Approved';
        $role = $request['userType'];
        Application::where('application_ID', $application_ID)->update([
            'status' => $status,
            'Kiosk_ID' => $kioskID,
        ]);

        return redirect()->route('applications.index', ['role' => $role])->with('Approve', $application_ID.' Has Been Approved');
    }

    public function reject(Request $request)
    {
        $application_ID = $request['id'];
        $status = 'Rejected';
        $role = $request['userType'];
        Application::where('application_ID', $application_ID)->update([
            'status' => $status,
            'reason'=> $request['reason'],
        ]);

        return redirect()->route('applications.index', ['role' => $role])->with('Reject', $application_ID.' Has Been Rejected');
    }

}

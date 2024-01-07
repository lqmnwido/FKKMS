<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role=Auth::user()->User_type;
        $type=request('type');
        return view('manage_report.reportList', compact('role', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $applications = Application::all();
        $users = User::all();
        $uid = Auth::user()->User_ID;

        $application = $applications->where("User_ID", $uid)->first();
        $role = Auth::user()->User_type;
        $user = $users->where("User_ID", $uid)->first();

        if ($role == 'FK Student' || $role == 'Vendor') {
            return view('manage_report.AddSalesReport', compact('user', 'application'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

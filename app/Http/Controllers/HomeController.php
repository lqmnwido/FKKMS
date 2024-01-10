<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $uid=Auth::user()->User_ID;
        $role=Auth::user()->User_type;

        $users = User::all();
        $complaints = Complaint::all();
        $applications = Application::where('User_ID', $uid)->first();

        if ($applications) {
            $userID = $applications->User_ID; 
        }else{
            $userID = null;
        }

        if($role=='Admin')
        {
            return view('admin_dashboard');
            
        }elseif($role== 'FK Bursary'){
            return view('manage_payment.mainPayment', compact('role'));
        }elseif($role== 'Pupuk Admin' || $role == 'FK Technical'){
            return view('manage_complaint.ViewComplaintList', compact('role', 'complaints', 'users'));
        }
        else
        {
            return view('dashboard', compact('userID','uid', 'role'));
        }
    }
}

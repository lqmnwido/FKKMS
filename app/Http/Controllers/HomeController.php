<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $uid=Auth::user()->User_ID;
        $role=Auth::user()->User_type;

        $applications = Application::where('User_ID', $uid)->first();

        if ($applications) {
            $userID = $applications->User_ID; 
        }else{
            $userID = null;
        }

        if($role=='Admin')
        {
            return view('admin_dashboard');
            
        }
        else
        {
            return view('dashboard', compact('userID','uid', 'role'));
        }
    }
}

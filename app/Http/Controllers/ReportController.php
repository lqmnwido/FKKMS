<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Report;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request('type');

        $role = Auth::user()->User_type;

        $listRole = request('role');

        if ($role == 'FK Student') {
            if ($type == 'List') {
                $uid = Auth::user()->User_ID;
                $reports = Report::where('User_ID', $uid)->get();
                return view('manage_report.reportList', compact('role', 'type', 'reports'));
            } else {
                return view('manage_report.reportList', compact('role', 'type'));
            }
        } else {
            if ($type == 'List') {
                $reports = Report::all();
                if($listRole == 'VEN'){
                    $repo = $reports->filter(function ($report) {
                        return str_contains($report->User_ID, 'VEN');
                    });
                }else{
                    $repo = $reports->filter(function ($report) {
                        return str_contains($report->User_ID, 'STD');
                    });
                }
                
                return view('manage_report.reportList', compact('role', 'type', 'repo', 'listRole'));
            } else {
                return view('manage_report.reportList', compact('role', 'type'));
            }
        }

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
        $currentDate = date('Y-m-d');
        Report::create([
            'Sales_ID' => $request['salesID'],
            'User_ID' => $request['User_ID'],
            'qty' => $request['qty'],
            'Tax_Rate' => $request['tRate'],
            'Tax' => $request['tax'],
            'Date' => $currentDate,
        ]);

        return redirect()->route('reports.index')->with('success', 'Report Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::where('id', $id)->first();

        $uid = $report->User_ID;

        $application = Application::where('User_ID', $uid)->first();


        return view('manage_report.ViewSalesReport', compact('id', 'report', 'application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = Report::where('id', $id)->first();

        $uid = $report->User_ID;

        $application = Application::where('User_ID', $uid)->first();


        return view('manage_report.EditSalesReport', compact('id', 'report', 'application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $report = Report::where('Sales_ID', $id)->first();

        $reportID = $report->id;

        Report::where('Sales_ID', $id)->update([
            'qty' => $request['qty'],
        ]);

        return redirect()->route('reports.edit', ['report' => $reportID])->with('success', 'Sales Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = 'List';
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('reports.index', ['type' => 'List'])->with('Alert', 'Sales Deleted!');
    }
}

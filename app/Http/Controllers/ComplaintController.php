<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $role = Auth::user()->User_type;

        if ($role == 'FK Student' || $role == 'Vendor') {
            return view('manage_complaint.AddComplaint', compact('users'));
        }elseif($role == 'Pupuk Admin'){
            return view('manage_complaint.ViewComplaintList', compact('users'));
        }elseif($role == 'FK Technical'){
            return view('manage_complaint.ViewComplaintList', compact('users'));
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
        $ranID = rand(10000, 99999);
        $complaintID = 'COM' . $ranID;

        $dateAndTime = $request['Date_Time'];
    
        

        $dateTimeObject = \DateTime::createFromFormat('Y-m-d\TH:i', $dateAndTime);

        $date = $dateTimeObject->format('Y-m-d');
        $time = $dateTimeObject->format('H:i:s');

        Complaint::create([
            'complaint_ID' => $complaintID,
            'User_ID' => $request['userID'],
            'Date' => $date,
            'Time' => $time,
            'complaintCategory_ID' => $request['complaintCategory'],
            'complaintStatus_ID' => 0,
            'details' => $request['complaintDetails'],
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint Submitted!');

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
        Complaint::where('id', $id)->update([
            'complaintStatus_ID' => $request['status'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint Status Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect()->route('dashboard')->with('Alert', 'Complaint Deleted!');
    }

    public function addNote()
    {
        $id = request('id');

        $complaint = Complaint::where('id', $id)->first();
        $uid = $complaint->User_ID;

        $user = User::where('User_ID', $uid)->first();

        return view('manage_complaint.AddNote', compact('id', 'complaint', 'user'));
    }

    public function updateNote(Request $request, string $id)
    {
        Complaint::where('id', $id)->update([
            'addNote' => $request['note'],
        ]);

        return redirect()->route('dashboard')->with('Success', 'Note Saved!');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_ID',
        'User_ID',
        'PupukAdmin_ID',
        'FKTechnicalTeam_ID',
        'complaintCategory_ID',
        'complaintStatus_ID',
        'details',
        'addNote',
        'Date',
        'Time',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'User_ID',
        'application_ID',
        'MatricID',
        'name',
        'User_type',
        'Product_name',
        'Price',
        'status',
        'reason',
        'Kiosk_ID',
    ];
}

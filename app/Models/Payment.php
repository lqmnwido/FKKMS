<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'Payment_ID',
        'User_ID',
        'PaymentType',
        'PaymentMonth',
        'PaymentDate',
        'Total_Price',
        'paymentOpt',
        'receipt',
        'remark',
    ];
}

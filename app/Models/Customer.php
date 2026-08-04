<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [

        'customer_code',
        'name',
        'email',
        'phone',
        'company_name',
        'gst_number',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'status',
        'notes',

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'company_code',

        'company_name',

        'contact_person',

        'email',

        'phone',

        'website',

        'gst_number',

        'address',

        'city',

        'state',

        'country',

        'logo',

        'status'

    ];
}
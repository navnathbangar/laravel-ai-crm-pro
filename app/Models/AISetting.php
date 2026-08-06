<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AISetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'provider',

        'model',

        'api_key',

        'temperature',

        'max_tokens',

        'status',

    ];
}
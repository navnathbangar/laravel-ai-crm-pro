<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'task_code',

        'title',

        'description',

        'assigned_to',

        'priority',

        'status',

        'start_date',

        'due_date',

        'completed_at',

    ];

    protected $casts = [

        'start_date' => 'date',

        'due_date' => 'date',

        'completed_at' => 'datetime',

    ];
}
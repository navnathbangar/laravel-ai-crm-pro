<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'lead_code',

        'lead_name',

        'company_name',

        'email',

        'phone',

        'source',

        'status',

        'expected_value',

        'follow_up_date',

        'notes',

        'created_by',

    ];

    protected function casts(): array
    {
        return [

            'follow_up_date'=>'date',

            'expected_value'=>'decimal:2',

        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
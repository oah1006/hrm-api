<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type',
        'start_day',
        'end_day',
        'reason',
        'status',
        'leave_type_id'
    ];
}

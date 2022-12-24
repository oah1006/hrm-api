<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_day',
        'end_day',
        'reason',
        'status',
        'leave_type_id',
        'employee_id'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType() {
        return $this->belongsTo(LeaveType::class);
    }
}

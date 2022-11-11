<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'emai',
        'token',
        'expires_at',
        'created_at'
    ];

    public $timestamps = false;

}

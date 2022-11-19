<?php

namespace App\Http\Controllers\Admin\Auth\Otp;

use App\Models\Otp;
use App\Mail\SendMail;
use App\Rules\RandomNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\Auth\Otp\SendOtpRequest;

class SendOtpController extends Controller
{
    public function requestOtp(SendOtpRequest $request) {
        $otp = fake()->randomNumber(6, true);
        
        $insertOtp = Otp::insert([
            'email' => $request->email,
            'token' => Hash::make($otp),
            'expire_at' => Carbon::now()->addMinutes(1),
        ]);


        Mail::to($request->email)->send(new SendMail($otp));

        return response()->json([
            'insertOtp' => $insertOtp,
            'message' => "OTP sent sucessfully!"
        ]);
    }
}

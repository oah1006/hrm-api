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
        
        $otps = Otp::where('email', $request->email)->first();
       
        $insertOtp = Otp::insert([
            'email' => $request->email,
            'token' => Hash::make($otp),
            'expires_at' => Carbon::now()->addMinutes(1),
        ]);


        Mail::to($request->email)->send(new SendMail($otp, $otps));

        return response()->json([
            'insertOtp' => $insertOtp,
            'message' => "OTP sent sucessfully!"
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth\Otp;

use App\Models\Otp;
use App\Mail\SendMail;
use App\Rules\RandomNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\Auth\Otp\SendOtpRequest;

class SendOtpController extends Controller
{
    public function requestOtp(SendOtpRequest $request) {
        $otp = fake()->randNumber(6, true);
        
        $insertOtp = Otp::insert([
            'token' => Hash::make($otp)
        ]);


        Mail::to($request->email)->send(new SendMail($otp));

        return response()->json([
            'message' => "OTP sent sucessfully!"
        ]);
    }
}

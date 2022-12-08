<?php

namespace App\Http\Controllers\Admin\Auth\Otp;

use App\Models\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\Otp\VerifyOtpRequest;

class VerifyOtpController extends Controller
{
    public function verifyOtp(VerifyOtpRequest $request) {
        $data = $request->validated();

        $otp = Otp::where('email', $request->email)->first();
        

        if ($otp && Hash::check($data['otpCode'], $otp->token) && $otp->expires_at > now()) {
            return response()->json([
                'token' => $otp->token,
                'message' => 'Your OTP is valid!'
            ]);
        }

        return response()->json([
            'message' => 'Your OTP is invalid!'
        ]);
    }
}

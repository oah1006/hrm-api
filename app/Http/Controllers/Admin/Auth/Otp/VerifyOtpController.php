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
        $otpCode = $request->validated();

        $otp = Otp::where('email', $request->email)->first();

        if ($otp && Hash::check($otpCode->token, $otp->token) && $otp->expires_at > now()) {
            return response()->json([
                'message' => 'Your OTP is valid!'
            ]);
        }
    }
}

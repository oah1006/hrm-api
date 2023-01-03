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
                'message' => 'OTP của bạn hợp lệ'
            ], 200);
        }

        return response()->json([
            'message' => 'OTP của bạn không hợp lệ! Vui lòng kiểm tra lại email'
        ], 400);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Otp;
use Illuminate\Http\Request;

class VerifyOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $otp = Otp::where('token', $request->header('token'))->first();
        
        if (!$otp || $otp->expires_at < now()) {
            return response()->json([
                "message" => "OTP is invalid!",
            ]);
        }
        $request->merge([
            "otp" => $otp,
        ]);
        
        return $next($request);

    }
}

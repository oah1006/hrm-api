<?php

namespace App\Http\Controllers\Admin\Auth;

use auth;
use App\Models\Otp;
use App\Models\User;
use App\Mail\SendMail;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request) {
        $data = $request->validated();

        $employee = Employee::where('email', $data['email'])->update([
            'password' => Hash::make($request->new_password),
        ]);

        $request->otp->delete();

        return response()->json([
            'employee' => $employee,
            'message' => "Update password employee successfully!"
        ]);
    }
}

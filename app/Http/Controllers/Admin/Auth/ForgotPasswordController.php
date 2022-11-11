<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Mail\SendMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    public function sendEmail(Request $request) {
        Mail::to($request->user())->send(new SendMail($request->user()));
    }
    
    public function sendRequestPasswordLink(Request $request) {
        
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use auth;
use App\Models\User;
use App\Mail\SendMail;
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
        $user = User::findOrFail($request->id);
        $user->password = bcrypt($data->password);

        return response()->json([
            'message' => 'Reset password sucessfully!'  
        ]);
    }
}

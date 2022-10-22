<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials  = $request->validated();

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => __('auth.failed')
            ], 401);
        }

        $employee = Employee::where('email', $credentials['email'])->first();
        $token = $employee->createToken('apitoken');

        return response()->json([
            'employee' => $employee,
            'token' => $token->plainTextToken()
        ]);
    }
}

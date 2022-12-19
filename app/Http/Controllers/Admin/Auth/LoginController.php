<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Laravel\Passport\HasApiTokens;


class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials  = $request->validated();

        $employee = Employee::where('email', $credentials['email'])->first();

        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            $token = $employee->createToken('apitoken');

            return response()->json([
                'employee' => $employee,
                'token' => $token->plainTextToken
            ]);     
        }

        return response()->json([
            'message' => __('auth.failed')
        ], 401);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully!']);
    }
}

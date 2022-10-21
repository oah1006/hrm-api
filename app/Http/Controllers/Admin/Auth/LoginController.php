<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\LoginRequest;



class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        $data = $request->validated();

        $employee = Employee::where('email', $data['email'])->first();

        if (!$employee || !Hash::check($data['password'], $employee->password)) {
            return response()->json([
                'message' => __('auth.failed')
            ], 401);
        }

        $token = $employee->createToken('apitoken');

        return response()->json([
            'employee' => $employee,
            'token' => $token->plainTextToken()
        ]);
    }
}

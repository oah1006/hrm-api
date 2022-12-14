<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request) {
        $user = $request->user();
        $credentials = $request->validated();

        if (Hash::check($credentials['old_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($credentials['password'])
            ]);

            return response()->json([
                'user' => $user
            ]);
        }
    }
}

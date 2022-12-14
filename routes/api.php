<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Leave\LeaveController;
use App\Http\Controllers\Admin\Auth\Otp\SendOtpController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Position\PositionController;
use App\Http\Controllers\Admin\Auth\Otp\VerifyOtpController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\LeaveType\LeaveTypeController;
use App\Http\Controllers\Admin\Department\DepartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/send-otp', [SendOtpController::class, 'requestOtp'])->name('send-otp');
        Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp'])->name('verify-otp');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password')->middleware('checkotp');       
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
        Route::apiResource('employees', EmployeeController::class)->middleware('isAdmin');
        Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');
        Route::put('/edit-profile', [EmployeeController::class, 'editProfile'])->name('editProfile');
        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('leave-types', LeaveTypeController::class);
        Route::apiResource('leaves', LeaveController::class);
    });

    
});
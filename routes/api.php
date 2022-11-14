<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Position\PositionController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
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
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
        Route::apiResource('employees', EmployeeController::class)->middleware('auth:sanctum');
        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('positions', PositionController::class);
    });

    
});
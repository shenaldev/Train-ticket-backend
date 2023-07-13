<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Email\EmailVerificationController;
use App\Http\Controllers\Api\V1\Public\LocationContoller;
use App\Http\Controllers\Api\V1\Public\TrainScheduleContoller;
use App\Http\Controllers\Api\V1\Roles\UserRolesController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/**
 * ALL THE PUBLIC ROUTES
 */
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix("v1")->group(function () {
    //LOCATION ROUTES
    Route::prefix('location')->group(function () {
        Route::get("/all", [LocationContoller::class, "locations"]);
    });
    //TRAIN SCHEDULE ROUTES
    Route::prefix('train-schedule')->group(function () {
        Route::post("/search", [TrainScheduleContoller::class, "search"]);
    });

});

/**
 * ONLY GUEST ROUTES
 */
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    //EMAIL VERIFY
    Route::post('/send-verification-email', [EmailVerificationController::class, 'send']);
    Route::post('/verify-email', [EmailVerificationController::class, 'verify']);
    //PASSWORD RESET
    Route::post('/forgot-password', [PasswordController::class, 'sendResetMail']);
    Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
    Route::post('/verify-token/{token}', [PasswordController::class, 'verifyToken']);
});

/**
 * PROTECTED ROUTES
 */
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    //USER ROLES FOR ADMIN
    Route::post('/user/roles/{user_id}/{role_id}', [UserRolesController::class, 'store']);
});

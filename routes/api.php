<?php

use App\Http\Controllers\Api\V1\Admin\ReservationController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Email\EmailVerificationController;
use App\Http\Controllers\Api\V1\Public\LocationContoller;
use App\Http\Controllers\Api\V1\Public\TrainScheduleContoller;
use App\Http\Controllers\Api\V1\Roles\UserRolesController;
use App\Http\Controllers\Api\V1\User\ReservationController as UserReservationController;
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
        Route::post("/seats", [TrainScheduleContoller::class, "scheduleSeats"]);
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
    //USER ROUTES
    Route::prefix('user')->group(function () {
        Route::get('/reservations', [UserReservationController::class, 'index']);
    });

    //ADMIN ROUTES
    Route::prefix('dashboard')->middleware(['auth:sanctum', "ability:admin"])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/all', [UserController::class, 'index']);
            Route::post('/roles/{user_id}/{role_id}', [UserRolesController::class, 'store']);
        });
        Route::post('/reservations/all', [ReservationController::class, 'index']);
    });
});

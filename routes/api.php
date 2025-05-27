<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Models\User;

// Route untuk mendapatkan user yang sedang login
Route::get('/user', function (Request $request) {
    $user = User::all();
    return response()->json([
        'success' => true,
        'data' => $user
    ], 200);
});

 Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/revoke-all-tokens', [AuthController::class, 'revokeAllTokens']);
        Route::get('/tokens', [AuthController::class, 'tokens']);
    });
    Route::apiResource('data-mahasiswa', MahasiswaController::class);
    Route::apiResource('data-dosen', DosenController::class);
});

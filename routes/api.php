<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EnrollmentController;

// ==========================================
// ROUTES PUBLIQUES — pas besoin de token
// ==========================================
Route::get('/formations',        [FormationController::class, 'index']);
Route::get('/formations/{slug}', [FormationController::class, 'show']);
Route::get('/categories',        [CategoryController::class, 'index']);
Route::post('/login',            [AuthController::class, 'login']);

// ==========================================
// ROUTES PROTÉGÉES — token obligatoire
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile',      [AuthController::class, 'profile']);
    Route::post('/logout',      [AuthController::class, 'logout']);
    Route::get('/enrollments',  [EnrollmentController::class, 'index']);
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
});

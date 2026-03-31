<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes publiques bilingues
Route::prefix('{locale}')->group(function () {
    // on ajoutera les routes publiques ici
});

// Routes admin
Route::prefix('admin')
    ->middleware(['auth', 'active'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

// Routes profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

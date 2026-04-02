<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\Admin\TrainingSessionController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\FormationController as PublicFormationController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\ContactController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes publiques bilingues
Route::prefix('{locale}')->where(['locale' => 'fr|en'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('public.home');

    Route::get('/formations', [PublicFormationController::class, 'index'])->name('public.formations');
    Route::get('/formations/{slug}', [PublicFormationController::class, 'show'])->name('public.formations.show');

    Route::get('/blog', [BlogController::class, 'index'])->name('public.blog');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('public.blog.show');

    Route::get('/contact', [ContactController::class, 'index'])->name('public.contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('public.contact.store');
});

// Routes admin
Route::prefix('admin')
    ->middleware(['auth', 'active'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::resource('formations', FormationController::class);
        Route::resource('sessions', TrainingSessionController::class);
        Route::resource('enrollments', EnrollmentController::class);
        Route::resource('posts', PostController::class);


    });
// Routes profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

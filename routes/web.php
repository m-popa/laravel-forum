<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IncrementThreadViewsMiddleware;

Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::get('/threads/{category:slug}', [ThreadController::class, 'index'])->name('threads.index');

Route::get('/categories/{category:slug}/threads/{thread:slug}', [ThreadController::class, 'show'])
     ->middleware([IncrementThreadViewsMiddleware::class])
     ->name('threads.show');

Route::get('/threads/create/{category:slug}', [ThreadController::class, 'create'])->name('threads.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

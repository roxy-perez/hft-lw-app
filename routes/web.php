<?php

use Illuminate\Support\Facades\Route;
use Devdojo\Auth\Http\Controllers\LogoutController;

Route::redirect('/', '/dashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('accounts', 'accounts.index')
    ->middleware(['auth'])
    ->name('accounts.index');

Route::view('accounts/create', 'accounts.create')
    ->middleware(['auth'])
    ->name('accounts.create');

// Authentication routes for TheDevDojo
Route::prefix('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});


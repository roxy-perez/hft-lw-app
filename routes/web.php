<?php

use Illuminate\Support\Facades\Route;
use Devdojo\Auth\Http\Controllers\LogoutController;
use Livewire\Volt\Volt;

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

Volt::route('accounts/{account}/edit', 'accounts.edit')
    ->middleware(['auth'])
    ->name('accounts.edit');

// Authentication routes for TheDevDojo
Route::prefix('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});


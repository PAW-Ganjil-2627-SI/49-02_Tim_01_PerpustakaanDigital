<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/penerbit');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/penerbit', [PenerbitController::class, 'index'])->name('penerbit.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('penerbit', PenerbitController::class)->except(['index', 'show']);
    });

    Route::get('/penerbit/{penerbit}', [PenerbitController::class, 'show'])
        ->whereNumber('penerbit')
        ->name('penerbit.show');
});

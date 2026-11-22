<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MemberController;
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
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
    Route::get('/area', [MejaController::class, 'index'])->name('area.index');
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{member}/card', [MemberController::class, 'card'])->name('members.card');

    Route::middleware('role:admin')->group(function () {
        Route::resource('penerbit', PenerbitController::class)->except(['index', 'show']);
        Route::resource('fasilitas', FasilitasController::class)
            ->parameters(['fasilitas' => 'fasilitas'])
            ->except(['index', 'show']);
        Route::resource('area', MejaController::class)
            ->parameters(['area' => 'meja'])
            ->except(['index', 'show']);
        Route::resource('buku', BukuController::class)->except(['index', 'show']);

        Route::post('/members', [MemberController::class, 'store'])->name('members.store');
        Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    });

    Route::get('/penerbit/{penerbit}', [PenerbitController::class, 'show'])
        ->whereNumber('penerbit')
        ->name('penerbit.show');
});

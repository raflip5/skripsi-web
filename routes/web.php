<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\ClassificationControllerC45;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::get('login', 'login');
        Route::post('login', 'onLogin')->name('login');
        Route::get('register', 'register');
        Route::post('register', 'onRegister')->name('register');
        //klasifikasi c45
        Route::get('/classification', [ClassificationControllerC45::class, 'index'])->name('classification.index');
        Route::post('/predict', [ClassificationControllerC45::class, 'predict'])->name('classification.predict');

    });
});

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('klasifikasi', ClasificationController::class)->only(['index', 'store']);
Route::resource('ganti', AccountController::class)->only(['index', 'store']);
Route::middleware('auth')->group(function() {
});

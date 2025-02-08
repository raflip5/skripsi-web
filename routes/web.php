<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\ClassificationControllerC45;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login');
        Route::post('login', 'onLogin')->name('login');
    });
});


Route::resource('klasifikasi', ClasificationController::class)->only(['index', 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('siswa', StudentController::class);
    Route::get('/siswa/lookup', [StudentController::class, 'lookupNIS'])->name('siswa.lookup');

    Route::resource('ganti', AccountController::class)->only(['index', 'store']);

    Route::get('report', [HistoryController::class, 'index'])->name('report');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Klasifikasi C45
    Route::get('/classification', [ClassificationControllerC45::class, 'index'])->name('classification.index');
    Route::post('/predict', [ClassificationControllerC45::class, 'predict'])->name('classification.predict');
    Route::get('/clasification', [ClassificationControllerC45::class, 'index'])->name('klasifikasi.start');
    Route::get('/predict', [ClassificationControllerC45::class, 'report'])->name('klasifikasi.report');
    Route::get('/data-training', [ClassificationControllerC45::class, 'dataTraining'])->name('data.training');
});

<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');
});

Route::middleware('auth')->group(function () {

    Route::resource('/dashboard', DashboardController::class)->names('dashboard');
    Route::get('counselor-panel', function () {
        return view('dashboard.counsellor.index');
    });
    Route::get('leads', function () {
        return view('report.lead-report.index');
    });
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

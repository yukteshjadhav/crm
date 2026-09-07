<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
        return view('dashboard1');
    });
    Route::get('leads', function () {
        return view('report.lead-report.index');
    });
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});


#Start Admin Routes
Route::middleware('auth')->group(function () {

    #Start route user 
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('users/delete/{id}', [UserController::class, 'destroy']);
    Route::get('users/changestatus/{id}', [UserController::class, 'changeStatus']);
    // Route::POST('password', [LeadController::class, 'changePassword']);
    // Route::POST('change-password', [LeadController::class, 'changePasswordTeal']);
    // Route::GET('password', [LeadController::class, 'password']);
    #End route user
});
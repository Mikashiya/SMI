<?php

use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::resource('/parts', AllocationsController::class);

Route::resource('/wh', WarehousesController::class);

Route::resource('/supplier', SupplierController::class);

Route::get('/dashboard/leader', function() { return view('leader.dashboard'); })->middleware('auth')->name('leader.dashboard');
Route::get('/dashboard/staff', function() { return view('dashboard_staff'); })->middleware('auth')->name('dashboard.staff');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/', function () {
    return view('login');
})->name('login');


<?php

use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('/parts', AllocationsController::class);

Route::resource('/wh', WarehousesController::class);

Route::resource('/supplier', SupplierController::class);

Route::get('/dashboard/leader', function() { return view('leader.dashboard'); })->middleware('auth')->name('leader.dashboard');
Route::get('/dashboard/staff', function() { return view('dashboard_staff'); })->middleware('auth')->name('dashboard.staff');

Route::get('/test-role', function() {
    return 'Middleware bekerja!';
})->middleware('role:leader');

Route::get('/', function () {
    return view('login');
})->name('login');


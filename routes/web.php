<?php

use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockMovementController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\ReportMiddleware;
use Illuminate\Support\Facades\Auth;

Route::resource('/auth', AuthController::class)->only(['index']);

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware([AuthMiddleware::class, ReportMiddleware::class])->group(function () {
    Route::get('/dashboard', function() { return view('leader.dashboard'); })->middleware('auth')->name('leader.dashboard');
    Route::resource('/parts', AllocationsController::class);
    Route::resource('/wh', WarehousesController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/mvt', StockMovementController::class);
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/', function () {
    return view('login');
})->name('login');


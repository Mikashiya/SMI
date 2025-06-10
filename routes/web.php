<?php

use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

Route::resource('/parts', AllocationsController::class);

Route::resource('/wh', WarehousesController::class);

Route::resource('/supplier', SupplierController::class);


Route::get('/', function () {
    return view('leader.dashboard');
})->name('leader.dashboard');

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

Route::get('/listparts', [AllocationsController::class, 'index'])->name('leader.listspareparts');


Route::get('/registparts', [AllocationsController::class, 'create'])->name('leader.registparts');

Route::delete('/parts/{part}', [AllocationsController::class, 'destroy'])->name('parts.destroy');
Route::get('/parts/{part}/edit', [AllocationsController::class, 'edit'])->name('parts.edit');
Route::put('/parts/{part}', [AllocationsController::class, 'update'])->name('parts.update');

Route::get('/listwh', [WarehousesController::class, 'index'])->name('leader.listwarehouses');
Route::get('/registwh', [WarehousesController::class, 'create'])->name('leader.registwh');
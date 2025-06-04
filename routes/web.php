<?php

use App\Http\Controllers\AllocationsController;
use App\Http\Controllers\Plant1Controller;
use App\Http\Controllers\Plant2Controller;
use App\Http\Controllers\Plant3Controller;
use App\Http\Controllers\SparepartsController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

Route::resource('/parts', AllocationsController::class);

Route::resource('/wh', WarehousesController::class);


Route::get('/', function () {
    return view('leader.dashboard');
})->name('leader.dashboard');

Route::get('/listparts', [AllocationsController::class, 'index'])->name('leader.listspareparts');

Route::get('/plant1', [Plant1Controller::class, 'index'])->name('leader.plant1');
Route::get('/plant2', [Plant2Controller::class, 'index'])->name('leader.plant2');
Route::get('/plant3', [Plant3Controller::class, 'index'])->name('leader.plant3');

Route::get('/registparts', [AllocationsController::class, 'create'])->name('leader.registparts');

Route::delete('/parts/{part}', [AllocationsController::class, 'destroy'])->name('parts.destroy');
Route::get('/parts/{part}/edit', [AllocationsController::class, 'edit'])->name('parts.edit');
Route::put('/parts/{part}', [AllocationsController::class, 'update'])->name('parts.update');


Route::get('/registwh', [WarehousesController::class, 'create'])->name('leader.registwh');
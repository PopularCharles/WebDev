<?php

use App\Http\Controllers\BookParkingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/index', function() {
    return view('index');
});
Route::get('/', [BookParkingController::class, 'table_data']);
Route::post('test-add', [BookParkingController::class, 'addtest'])->name('addtest.custom');
Route::post('test/update/{day}', [BookParkingController::class, 'update'])->name('data.update');
Route::post('test/delete/{day}', [BookParkingController::class, 'destroy']) ->name('data.destroy');
require __DIR__.'/auth.php';

<?php
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/devices', [DeviceController::class, 'index']); // Mengarahkan ke metode index pada DeviceController
Route::get('/devices/{id}', [DeviceController::class, 'show']); // Mengarahkan ke metode show pada DeviceController
Route::post('/devices', [DeviceController::class, 'store']); // Mengarahkan ke metode store pada DeviceController
Route::put('/devices/{id}', [DeviceController::class, 'update']); // Mengarahkan ke metode update pada DeviceController
Route::delete('/devices/{id}', [DeviceController::class, 'destroy']); // Mengarahkan ke metode destroy pada DeviceController

Route::get('/rules', function () {
    return view('rules');
});

Route::get('/users', function () {
    return view('users');
});

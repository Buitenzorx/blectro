<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;

Route::get('/dashboard', function(){
    return view('dashboard');
});
Route::get('/devices', [DeviceController::class, 'showDevices']);
Route::get('/devices/{id}', [DataController::class, 'web_show']);
Route::get('/rules', function(){
    return view('rules');
});
Route::get('/users', function(){
    return view('users');
});
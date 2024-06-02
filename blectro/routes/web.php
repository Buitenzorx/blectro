<?php
use Illuminate\Support\Facades\Route;
use App\Models\Device;
use App\Models\Data;
use App\Models\Notification;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatalogController;
use App\Http\Controllers\NotificationController;

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/devices', [DeviceController::class, 'showDevices']);

Route::get('/devices', [DeviceController::class, 'showDevices']);
Route::get('/devices/{id}', [DataController::class, 'web_show']);
Route::get('/datalogs', [DatalogController::class, 'web_show']);
Route::get('/notification', [NotificationController::class, 'web_show']);

Route::get('/nodestate', function(){
    return view('nodestate');
});
Route::get('/users', function(){
    return view('users');
});
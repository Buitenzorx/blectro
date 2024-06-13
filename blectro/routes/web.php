<?php
use Illuminate\Support\Facades\Route;
use App\Models\Device;
use App\Models\Data;
use App\Models\Notification;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatalogController;
use App\Http\Controllers\NotificationController;

Route::get('/dashboard', [DeviceController::class, 'webDashboard']);

Route::get('/devices', [DeviceController::class, 'showDevices']);

Route::get('/devices', [DeviceController::class, 'showDevices']);
Route::get('/devices/{id}', [DataController::class, 'web_show']);
Route::get('/datalogs', [DatalogController::class, 'web_show']);
Route::get('/notification', [NotificationController::class, 'web_show']);
Route::post('/data/{id}', [DeviceController::class, 'updateData']);
Route::put('/data/{id}', [DataController::class, 'updateData']);
Route::post('/toggle-led', [DeviceController::class, 'toggleLED'])->name('toggle-led');
Route::get('/rain-sensor-data', [DataController::class, 'getRainSensorData'])->name('rain-sensor-data');
Route::get('/nodestate', function(){
    return view('nodestate');
});
Route::get('/users', function(){
    return view('users');
});


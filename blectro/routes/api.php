<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatalogController;
use App\Http\Controllers\NotificationController;


Route::get('/user', function (Request $request) { return $request ->user(); })->middleware('auth:sanctum');
Route::get('/devices', [DeviceController::class, 'index']);
Route::post('/devices', [DeviceController::class, 'store']);
Route::get('/devices/{id}', [DeviceController::class, 'show']);
Route::put('/devices/{id}', [DeviceController::class,'update']);
Route::delete('/devices/{id}', [DeviceController::class,'destroy']);


Route::get('/data', [DataController::class, 'index']);
Route::post('/data', [DataController::class, 'store']);
Route::get('/data/{id}', [DataController::class, 'show']);


Route::post('/datalogs', [DatalogController::class, 'store']);
Route::get('/datalogs', [DatalogController::class, 'index']);
Route::put('/datalogs/{device_id}', [DatalogController::class, 'update']);

Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications', [NotificationController::class, 'store']);


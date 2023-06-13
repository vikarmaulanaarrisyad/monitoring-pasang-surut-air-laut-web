<?php

use App\Http\Controllers\Api\SensorLaravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sensor/data',[SensorLaravelController::class, 'getDataSensor'])->name('sensor.data');
Route::get('/sensor/ajax',[SensorLaravelController::class, 'getSensorAjax'])->name('sensor.ajax');
Route::get('/sensor/kecepatan',[SensorLaravelController::class, 'getKecepatanAll'])->name('sensor.kecepatan_all');
Route::get('/sensor',[SensorLaravelController::class, 'getSingleDataSensor'])->name('sensor.data_single');
Route::get('/sensor/data_multiple',[SensorLaravelController::class, 'data_multiple'])->name('sensor.data_multiple');

Route::get('/sensor/{sensor}/status/{status}',[SensorLaravelController::class, 'store'])->name('sensor.store');

Route::post('/kirim_data', [SensorLaravelController::class, 'kirimDataSensor']);


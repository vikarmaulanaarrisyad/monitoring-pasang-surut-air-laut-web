<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.front');
});

Route::group([
    'middleware' => ['auth', 'role:admin,user'],
], function () {
    // Route::get('/', function () {
    //     return redirect()->route('dashboard');
    // });

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


    Route::group([
        'middleware' => 'role:admin',
    ], function () {
        //
        Route::resource('/sensor', SensorController::class);
    });


    Route::group([
        'middleware' => 'role:user',
    ], function () {
        //
    });
});

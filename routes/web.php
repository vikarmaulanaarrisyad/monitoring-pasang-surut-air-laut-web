<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [FrontController::class, 'index']);

Route::group([
    'middleware' => ['auth', 'role:admin,user'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group([
        'middleware' => 'role:admin',
    ], function () {
        //
        Route::resource('/sensor', SensorController::class);

        Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
        Route::resource('/category', CategoryController::class)->except('create');

        Route::get('/posts/data', [PostController::class, 'data'])->name('posts.data');
        Route::resource('posts', PostController::class);
        Route::get('/posts/{id}/detail', [PostController::class, 'detail'])->name('posts.detail');

        Route::get('/setting', [SettingController::class, 'index'])
            ->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])
            ->name('setting.update');

        Route::get('/report/data/{start}/{end}', [ReportController::class, 'data'])->name('report.data');
        Route::get('/report/pdf/{start}/{end}', [ReportController::class, 'exportPDF'])->name('report.export_pdf');
    });


    Route::group([
        'middleware' => 'role:user',
    ], function () {
        //
    });
});

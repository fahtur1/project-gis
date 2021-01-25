<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::prefix('/user')->group(function () {

    Route::get('/', [UserController::class, 'show'])->name('user');
    Route::get('/about', [UserController::class, 'showAbout'])->name('about');
    Route::get('/maps', [UserController::class, 'showMaps'])->name('maps');

});

Route::prefix('/admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('/list_place')->group(function () {
        Route::get('/', [AdminController::class, 'list_place'])->name('list_place');

        Route::get('/delete/{id}', [DataController::class, 'delete'])->name('delete');

        Route::get('/update_data/{id}', [DataController::class, 'showUpdate'])->name('update_data.get');
        Route::post('/update_data', [DataController::class, 'update'])->name('update_data.post');

        Route::get('/detail_data/{id}', [AdminController::class, 'detail'])->name('detail_data');

        Route::get('/add_data', [DataController::class, 'show'])->name('add_data.get');
        Route::post('/add_data', [DataController::class, 'create'])->name('add_data.post');

        Route::post('/add_json', [DataController::class, 'uploadJson'])->name('add_json');

        Route::get('/delete_all', [DataController::class, 'deleteAllData'])->name('delete_all');

        Route::get('/print', [DataController::class, 'printToGeoJson'])->name('print');
    });

});



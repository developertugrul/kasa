<?php

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

Route::get('/', [App\Http\Controllers\Home\IndexController::class, 'index'])->name('home');
Route::group(['prefix' => 'products', "as" => "products."], function () {
    Route::get('/', [App\Http\Controllers\Urunler\IndexController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\Urunler\IndexController::class, 'add'])->name('add');
    Route::post('/update', [App\Http\Controllers\Urunler\IndexController::class, 'update'])->name('update');
    Route::post('/delete', [App\Http\Controllers\Urunler\IndexController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'product-categories', "as" => "product-categories."], function () {
    Route::get('/', [App\Http\Controllers\UrunKategorileri\IndexController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\UrunKategorileri\IndexController::class, 'add'])->name('add');
    Route::post('/update', [App\Http\Controllers\UrunKategorileri\IndexController::class, 'update'])->name('update');
    Route::post('/delete', [App\Http\Controllers\UrunKategorileri\IndexController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'vendors', "as" => "vendors."], function () {
    Route::get('/', [App\Http\Controllers\Tedarikciler\IndexController::class, 'index'])->name('index');
    Route::post('/add', [App\Http\Controllers\Tedarikciler\IndexController::class, 'add'])->name('add');
    Route::post('/update', [App\Http\Controllers\Tedarikciler\IndexController::class, 'update'])->name('update');
    Route::post('/delete', [App\Http\Controllers\Tedarikciler\IndexController::class, 'delete'])->name('delete');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/stock/index', [App\Http\Controllers\StockController::class, 'index'])->name('stock.index');
Route::get('/stock/create', [App\Http\Controllers\StockController::class, 'create'])->name('stock.create');
Route::post('/stock/create', [App\Http\Controllers\StockController::class, 'store']);
Route::get('/prices', [App\Http\Controllers\StockController::class, 'prices'])->name('stock.prices');
Route::get('/stock/prices', [App\Http\Controllers\StockController::class, 'priceList'])->name('pricelist');
Route::get('/stock/priceGenerator', [App\Http\Controllers\StockController::class, 'priceGenerator'])->name('priceGenerator');
// Route::post('/stock/create', [App\Http\Controllers\StockController::class, 'store']);

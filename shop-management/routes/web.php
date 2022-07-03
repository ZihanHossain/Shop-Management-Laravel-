<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'validateLogin']);
Route::get('/products', [ProductsController::class, 'index'])->name('Products');
Route::post('/add-product', [ProductsController::class, 'addProduct']);
Route::get('/sell-counter', function(){
 return view('sell_counter');
});

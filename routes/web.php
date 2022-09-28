<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;


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

Route::view('/', 'site.pages.homepage');

Route::get('/category/{slug}', [CategoryController::class,'show'])->name('category.show');

Route::get('/product/{slug}', [ProductController::class,'show'])->name('product.show');

Route::post('/product/add/cart', [ProductController::class,'addToCart'])->name('product.add.cart');

require 'admin.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

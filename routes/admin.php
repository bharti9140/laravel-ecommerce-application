<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ADMIN routes for your application.
*/

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });

    Route::group(['prefix'  =>   'categories'], function () {

        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    });

    Route::group(['prefix'  =>   'attributes'], function () {

        Route::get('/', [AttributeController::class, 'index'])->name('admin.attributes.index');
        Route::get('/create', [AttributeController::class, 'create'])->name('admin.attributes.create');
        Route::post('/store', [AttributeController::class, 'store'])->name('admin.attributes.store');
        Route::get('/{attribute_id}/edit', [AttributeController::class, 'edit'])->name('admin.attributes.edit');
        Route::post('/update', [AttributeController::class, 'update'])->name('admin.attributes.update');
        Route::get('/{id}/delete', [AttributeController::class, 'delete'])->name('admin.attributes.delete');

        Route::post('/add-values/{id?}', [AttributeValueController::class, 'addValues'])->name('admin.attributes.value.store');
        Route::get('/{id}/delete-values', [AttributeValueController::class, 'deleteValues'])->name('admin.attributes.value.delete');
    });

    Route::group(['prefix'  =>   'brands'], function() {

        Route::get('/', [BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('/create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::post('/update', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::get('/{id}/delete', [BrandController::class, 'delete'])->name('admin.brands.delete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/{id}/delete', [ProductController::class, 'delete'])->name('admin.products.delete');
     });
});

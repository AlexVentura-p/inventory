<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\OrderListController;
use App\Http\Controllers\Admin\ProductManagerController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\RatingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoppingCartController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('products',[ProductController::class,'index']);
Route::get('products/{product:title}',[ProductController::class,'productDetails']);


Route::middleware('auth')->group(function () {
    Route::post('products/ratings/store',[RatingController::class,'store']);
    Route::post('cart/add',[ShoppingCartController::class,'add']);
    Route::get('cart',[ShoppingCartController::class,'index']);
    Route::post('order/store',[OrderController::class,'store']);
});

Route::middleware('admin')->group(function () {

    Route::get('admin/products',[AdminProductController::class,'index']);

    Route::get('admin/products/{product:title}',[AdminProductController::class,'productDetails']);

    Route::post('admin/products/store',[ProductManagerController::class,'store']);

    Route::get('admin/products/manager/create',[ProductManagerController::class,'createForm']);

    Route::post('admin/products/delete/{product:title}',[ProductManagerController::class,'delete']);

    Route::get('admin/products/manager/edit/{product:title}',[ProductManagerController::class,'editForm']);

    Route::patch('admin/products/edit/{product}',[ProductManagerController::class,'edit']);

    Route::get('orders',[OrderListController::class,'index']);

});


require __DIR__.'/auth.php';

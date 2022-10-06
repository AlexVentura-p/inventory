<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManagementController;
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
Route::get('products',[ProductController::class,'showProductsForCustomer']);
Route::get('products/{product:title}',[ProductController::class,'productDetails']);


Route::middleware('admin')->group(function () {

    Route::get('admin/products',[ProductController::class,'showProductsForAdmin']);

    Route::get('admin/products/{product:title}',[ProductController::class,'productDetailsAdmin']);

    Route::post('admin/products/store',[ProductManagementController::class,'store']);

    Route::get('admin/products/manager/create',[ProductManagementController::class,'createProductForm']);

    Route::post('admin/products/delete/{product:title}',[ProductManagementController::class,'delete']);

    Route::get('admin/products/manager/edit/{product:title}',[ProductManagementController::class,'editPage']);

    Route::patch('admin/products/edit/{product}',[ProductManagementController::class,'edit']);

});


require __DIR__.'/auth.php';

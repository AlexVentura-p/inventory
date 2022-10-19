<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\Order\OrderListController;
use App\Http\Controllers\Admin\Product\ProductAdminController;
use App\Http\Controllers\Admin\ProductManagerController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductCustomerController;
use App\Http\Controllers\Customer\RatingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCart\ShoppingCartController;
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
Route::get('products',[ProductCustomerController::class,'index']);
Route::get('products/{product:title}',[ProductCustomerController::class,'productDetails']);


Route::middleware('customer')->group(function () {

    Route::post('cart/add',[ShoppingCartController::class,'store']);

    Route::post('products/ratings/store',[RatingController::class,'store']);

    Route::get('cart',[ShoppingCartController::class,'index']);

    Route::post('order/store',[OrderController::class,'store']);
});

Route::middleware('admin')->group(function () {

    Route::get('orders',[OrderListController::class,'index']);

    Route::resource('admin/products', ProductAdminController::class);

});
Route::get('test',function (){
    return request('code');
});
require __DIR__.'/auth.php';

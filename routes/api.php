<?php

use App\Api\Controllers\Admin\Products\AdminProductController;
use App\Api\Controllers\Customer\Orders\OrderCustomerController;
use App\Api\Controllers\Customer\Products\ProductCustomerController;
use App\Api\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user', [UserController::class, 'show'])->middleware('auth:api');

Route::get('/products', [ProductCustomerController::class, 'show'])
    ->middleware('no_admin_access');

Route::middleware(['auth:api', 'customer'])->group(function () {
    Route::get('customer/orders', [OrderCustomerController::class, 'index']);
    Route::get('customer/orders/{order}', [OrderCustomerController::class, 'show']);
});

Route::middleware(['auth:api', 'admin'])->group(function () {

    Route::apiResource('admin/products', AdminProductController::class)->except([
        'update'
    ]);
    Route::put('admin/products/{product}',[AdminProductController::class,'update']);
    Route::patch('admin/products/{product}',[AdminProductController::class,'patch']);

});


Route::get('test', function () {
    return response()->get('code');
});

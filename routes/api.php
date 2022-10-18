<?php

use App\Api\Controllers\Admin\Products\AdminProductController;
use App\Api\Controllers\Customer\Orders\OrderCustomerController;
use App\Api\Controllers\UserController;
use Illuminate\Http\Request;
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


Route::middleware('auth:api')->group(function () {

    Route::get('user',[UserController::class,'show']);
    Route::get('customer/orders',[OrderCustomerController::class,'show']);

});

Route::apiResource('admin/products',AdminProductController::class);

Route::get('test',function (){
   return response()->get('code');
});

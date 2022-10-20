<?php

namespace App\Api\Controllers\Customer\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;

class OrderCustomerController extends Controller
{
    public function index()
    {
        $customer = User::find(request()->user()->id);

        return response($customer->orders);
    }

    public function show(Order $order)
    {

        if ($order->user_id == request()->user()->id){
            return OrderResource::make($order);
        }

        return response(['message' => 'Unauthorized'],401);

    }

}

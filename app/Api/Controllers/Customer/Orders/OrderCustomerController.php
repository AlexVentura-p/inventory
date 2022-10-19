<?php

namespace App\Api\Controllers\Customer\Orders;

use App\Http\Controllers\Controller;
use App\Models\User;

class OrderCustomerController extends Controller
{
    public function show()
    {
        $customer = User::find(request()->user()->id);

        return response($customer->orders);
    }
}

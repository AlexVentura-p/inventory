<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderListController extends Controller
{
    public function index()
    {

        return view('product.admin.order-list-admin',[
            'orders' => Order::paginate(2)
        ]);
    }
}

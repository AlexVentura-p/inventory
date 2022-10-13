<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\RateConverter\RateConverter;
use App\Models\Order;

class OrderListController extends Controller
{
    public $converter;

    public function __construct(RateConverter $converter)
    {
        $this->converter = $converter;
    }

    public function index()
    {
        return view('product.admin.order-list-admin',[
            'converter' => $this->converter,
            'orders' => Order::paginate(2)
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store()
    {
        $session = request()->session();

        array_map(function ($item){
            LineItem::create([
                'order_id' => request()->session()->get('order')->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'item_total' => $item->item_total
            ]);
        },$session->get('items_list'));

        $session->get('order')->updateTotals();

        $session->forget(['order','items_list']);

        return redirect('products');
    }
}

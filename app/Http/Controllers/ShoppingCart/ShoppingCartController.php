<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Models\LineItem;
use App\Models\Order;
use App\Models\Product;

class ShoppingCartController extends Controller
{

    public function index()
    {
        if (!request()->session()->exists('items_list')) {
            return redirect('products');
        }

        return view('cart.item-list', [
            'items_list' => request()->session()->get('items_list')
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'product_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric', 'min:1']
        ]);

        $this->checkIfOrderExists();

        $product = Product::find($attributes['product_id']);

        request()->session()->push(
            'items_list',
            new LineItem([
                'product_id' => $product->id,
                'quantity' => $attributes['quantity'],
                'unit_price' => $product->unit_price,
                'item_total' => $product->unit_price * $attributes['quantity']
            ])
        );

        return redirect('products');
    }

    private function checkIfOrderExists()
    {
        $session = request()->session();

        if (!$session->exists('order')) {
            $session->put(
                'order',
                Order::create([
                    'user_id' => auth()->user()->id
                ])
            );

            $session->put('items_list', []);
        }
    }

}

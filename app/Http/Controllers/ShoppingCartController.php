<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{

    public function index()
    {
        if (!request()->session()->exists('items_list')){
            return redirect('products');
        }
        //dd(request()->session()->get('items_list'));
        return view('cart.item-list',[
            'items_list' => request()->session()->get('items_list')
        ]);
    }

    public function add()
    {
        $attributes = request()->validate([
            'product_id' => ['required','numeric'],
            'quantity' => ['required','numeric','min:1']
        ]);

        $session = request()->session();

        if (!$session->exists('order')){

            $session->put('order',Order::create([
                'user_id' => auth()->user()->id
            ]));

            $session->put('items_list',[]);
        }

        $product = Product::find($attributes['product_id']);

        $session->push('items_list', new LineItem([
            'product_id' => $product->id,
            'quantity' => $attributes['quantity'],
            'unit_price' => $product->unit_price,
            'item_total' => $product->unit_price * $attributes['quantity']
        ]));

        return redirect('products');
    }
}

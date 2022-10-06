<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductManagerController extends Controller
{

    public function createForm()
    {
        return view('product.create-product');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric'],
            'type' => ['required'],
            'is_visible' => ['required','numeric']
        ]);

        Product::create($attributes);

        return redirect('admin/products/'.$attributes['title']);
    }

    public function delete(Product $product)
    {

        Product::where('id','=',$product->id)->delete();

        return redirect('admin/products');
    }

    public function editForm(Product $product)
    {
        return view('product.edit-product',[
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {

        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric'],
            'type' => ['required'],
            'is_visible' => ['required','numeric']
        ]);

        $product->update($attributes);


        return redirect('admin/products/'.$attributes['title']);;

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductManagementController extends Controller
{

    public function createProductForm()
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

    public function editPage(Product $product)
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\OptimizeProductImage;
use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductManagerController extends Controller
{

    public function createForm()
    {
        return view('product.admin.create-product');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required','numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:1024']
        ]);

        $product = Product::create($attributes);

        if (request()->hasFile('image'))
        {
            $path = request()->file('image')->storeAs(
                'products',
                $product->product_title.'.'.request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            $product = Product::where('title','=',$product->product_title);
            $product->update(['image' => $path]);
            OptimizeProductImage::dispatch($path);
        }

        return redirect('admin/products/'.$attributes['title']);
    }

    public function delete(Product $product)
    {

        Product::where('id','=',$product->id)->delete();

        return redirect('admin/products');
    }

    public function editForm(Product $product)
    {
        return view('product.admin.edit-product',[
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {

        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required','numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:2024']
        ]);

        $product->update($attributes);

        if (request()->hasFile('image'))
        {
            $path = request()->file('image')->storeAs(
                'products',
                $product->title.'.'.request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            $product = Product::where('title','=',$product->title);
            $product->update(['image' => $path]);
            OptimizeProductImage::dispatch($path);
        }


        return redirect('admin/products/'.$attributes['title']);;

    }

}

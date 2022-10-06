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

    public function store(Request $request)
    {
        $attributes = $request->validate([
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

        return view('product.products-list-admin');
    }

    public function edit(Request $request)
    {

        $request->validate(['id' => ['required']]);
        $this->validateProductDetails($request);

        $product = Product::find($request->id);

    }

//    private function validateProductDetails(Request $request)
//    {
//        return $request->validate([
//            'title' => ['required', 'string', 'max:255',Rule::unique('title','products')],
//            'description' => ['required', 'string', 'max:255'],
//            'unit_price' => ['required', 'numeric'],
//            'type' => ['required'],
//            'is_visible' => ['required','numeric']
//        ]);
//    }
}

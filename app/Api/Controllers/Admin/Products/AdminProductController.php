<?php

namespace App\Api\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Product::paginate(2),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required','numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:2048'],
            'category_id' => ['required']
        ]);

        $categoryId = $attributes['category_id'];
        unset($attributes['category_id']);

        $product = Product::create($attributes);

        //$this->storeImage($product);

        $product->categories()->attach($categoryId);

        return response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'description' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['nullable', 'numeric','min:0.01'],
            'type' => ['nullable'],
            'is_visible' => ['nullable','numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:2024']
        ]);

        $product->update($attributes);

        //$this->storeImage($product);

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id','=',$product->id)->delete();

        return response()->noContent();
    }
}

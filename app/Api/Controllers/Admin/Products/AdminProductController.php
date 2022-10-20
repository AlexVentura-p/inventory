<?php

namespace App\Api\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Services\Images\ImageFormService;
use App\Models\Product;
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
        return response(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $attributes = $request->validated();

        $categoryId = $attributes['category_id'];
        unset($attributes['category_id']);

        $attributes['image'] = ImageFormService::store('products', $attributes['title']);

        $product = Product::create($attributes);

        $product->categories()->attach($categoryId);

        return response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric', 'min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required', 'numeric']
        ]);

        $product->update($attributes);

        return response($product);
    }

    public function patch(Product $product)
    {
        $attributes = request()->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['nullable', 'numeric', 'min:0.01'],
            'type' => ['nullable'],
            'is_visible' => ['nullable', 'numeric']
        ]);

        $product->update($attributes);

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id', '=', $product->id)->delete();

        return response('No Content', 204);
    }


}

<?php

namespace App\Api\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ImportProductsRequest;
use App\Http\Requests\Product\PatchProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Services\Images\ImageFormService;
use App\Http\Services\Product\FileParser\ParserFactory;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Rules\ImportExtensionRule;

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

        return response($product, 201);
    }

    /**
     * Display the specified resource.
     *
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
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        $attributes = $request->validated();

        $attributes['image'] = ImageFormService::store('products', $attributes['title']);

        $product->update($attributes);

        return response($product);
    }

    public function patch(Product $product, PatchProductRequest $request)
    {
        $attributes = $request->validated();

        $title = $attributes['title'] ?? false ? $attributes['title'] : $product->title;

        if ($attributes['image'] ?? false) {
            $attributes['image'] = ImageFormService::store('products', $title);
        }

        $product->update($attributes);

        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id', '=', $product->id)->delete();

        return response('No Content', 204);
    }


    public function import(ProductService $productService)
    {
        request()->validate([
            'products' => ['bail','required', new ImportExtensionRule('products')]
        ]);

        $file = request()->file('products');

        $productService->setParser(
            ParserFactory::getParser($file->getClientOriginalExtension())
        );

        return response(
            $productService->import($file)
        );
    }
}

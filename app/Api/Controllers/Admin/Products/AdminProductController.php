<?php

namespace App\Api\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Jobs\OptimizeProductImage;
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

        $attributes['image'] = $this->storeImage2('products', $attributes['title']);

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
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['nullable', 'numeric', 'min:0.01'],
            'type' => ['nullable'],
            'is_visible' => ['nullable', 'numeric'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024']
        ]);

        $product->image = $this->storeImage2('products', $attributes['title']);

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

    private function storeImage(Product $product)
    {
        if (request()->hasFile('image')) {
            $path = request()->file('image')->storeAs(
                'products',
                $product->title . '.' . request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            $product = Product::where('title', '=', $product->title);
            $product->update(['image' => $path]);
            OptimizeProductImage::dispatch($path);
        }
    }

    private function storeImage2(string $folder, $imageTitle)
    {
        if (request()->hasFile('image')) {
            $path = request()->file('image')->storeAs(
                $folder,
                $imageTitle . '.' . request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            OptimizeProductImage::dispatch($path);

            return $path;
        }
    }

}

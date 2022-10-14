<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Jobs\OptimizeProductImage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('product.admin.products-list-admin', [
            'products' => Product::filter(request(['search', 'sortBy', 'minPrice', 'maxPrice','category']))
                ->paginate(10),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('product.admin.create-product',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'string', 'max:255',Rule::unique('products','title')],
            'description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'type' => ['required'],
            'is_visible' => ['required','numeric'],
            'image' => ['nullable','mimes:jpg,jpeg,png','max:2048'],
            'category' => ['required']
        ]);

        $categoryId = $attributes['category'];
        unset($attributes['category']);

        $product = Product::create($attributes);

        $this->storeImage($product);

        $product->categories()->attach($categoryId);

        return redirect('admin/products/'.$attributes['title']);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Product $product)
    {
        return view('product.admin.product-details-admin',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Product $product)
    {
        return view('product.admin.edit-product',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Product $product)
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

        $this->storeImage($product);

        return redirect('admin/products/'.$attributes['title']);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Product $product)
    {
        Product::where('id','=',$product->id)->delete();

        return redirect('admin/products');
    }


    private function storeImage(Product $product)
    {
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
    }
}

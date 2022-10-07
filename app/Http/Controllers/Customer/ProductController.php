<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.products-list', [
            'products' => Product::where('is_visible', '=', 1)
                ->filter(request(['search', 'sortBy', 'minPrice', 'maxPrice']))
                ->paginate(10)
        ]);
    }


    public function productDetails(Product $product)
    {
        if ($product->is_visible == 0){
            abort(404);
        }

        return view('product.product-details',[
            'product' => $product
        ]);

    }


}

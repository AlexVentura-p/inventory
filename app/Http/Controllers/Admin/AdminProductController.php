<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        return view('product.products-list-admin', [
            'products' => Product::filter(request(['search', 'sortBy', 'minPrice', 'maxPrice']))
                ->paginate(10)
        ]);
    }

    public function productDetails(Product $product)
    {

        return view('product.product-details-admin',[
            'product' => $product
        ]);

    }

}

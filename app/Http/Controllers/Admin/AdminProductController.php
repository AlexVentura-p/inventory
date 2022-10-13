<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {

        return view('product.admin.products-list-admin', [
            'products' => Product::filter(request(['search', 'sortBy', 'minPrice', 'maxPrice','category']))
                ->paginate(10),
            'categories' => Category::all()
        ]);
    }

    public function productDetails(Product $product)
    {

        return view('product.admin.product-details-admin',[
            'product' => $product
        ]);

    }

}

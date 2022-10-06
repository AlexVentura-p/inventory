<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductsForCustomer()
    {
        return view('product.products-list', [
            'products' => Product::where('is_visible', '=', 1)
                ->filter(request(['search', 'sortBy', 'minPrice', 'maxPrice']))
                ->paginate(10)
        ]);
    }

    public function showProductsForAdmin()
    {
        return view('product.products-list-admin', [
            'products' => Product::filter(request(['search', 'sortBy', 'minPrice', 'maxPrice']))
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

    public function productDetailsAdmin(Product $product)
    {

        return view('product.product-details-admin',[
            'product' => $product
        ]);

    }
}

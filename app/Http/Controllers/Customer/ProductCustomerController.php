<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductCustomerController extends Controller
{
    public function index()
    {
        return view('product.products-list', [
            'products' => Product::where('is_visible', '=', 1)
                ->filter(request(['search', 'sortBy', 'minPrice', 'maxPrice','category']))
                ->paginate(10),
            'categories' => Category::all()
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

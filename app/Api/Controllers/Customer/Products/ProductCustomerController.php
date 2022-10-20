<?php

namespace App\Api\Controllers\Customer\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;

class ProductCustomerController extends Controller
{
    public function show()
    {
        return new ProductCollection(
            Product::where('is_visible', '=', '1')
                ->paginate(5)
        );
    }
}

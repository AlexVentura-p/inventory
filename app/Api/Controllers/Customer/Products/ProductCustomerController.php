<?php

namespace App\Api\Controllers\Customer\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductCustomerController extends Controller
{
    public function show()
    {
        return response(
            Product::where('is_visible', '=', '1')
                ->paginate(2, [
                    'title',
                    'type',
                    'description',
                    'unit_price',
                    'rating',
                    'image'])
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductsForCustomer(){

         return view('products',[
             'products' => Product::where('is_visible','=',1)
                 ->filter(request(['search', 'sortBy','minPrice','maxPrice']))
                 ->paginate(10)
         ]);
    }
}

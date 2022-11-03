<?php

namespace App\Http\Services\Product;

use App\Http\Services\Product\FileParser\CsvProductParser;
use App\Http\Services\Product\FileParser\JsonProductParser;
use App\Http\Services\Product\FileParser\ProductFileParser;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public static function import(UploadedFile $file) : array
    {
        $extension = ($file->getClientOriginalExtension());

        $products= [];

        if ($extension == 'json'){
            $products = ProductFileParser::parse(new JsonProductParser(),$file);
        }

        if ($extension == 'csv'){
            $products = ProductFileParser::parse(new CsvProductParser(),$file);
        }

        return array_map(function ($product){
            return self::store($product);
        },$products);

    }

    public function store(Product $product): Product
    {
        $product->is_visible = 1;
        $product->save();
        return $product;
    }
}

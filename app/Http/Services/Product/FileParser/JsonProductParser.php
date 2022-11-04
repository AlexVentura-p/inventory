<?php

namespace App\Http\Services\Product\FileParser;

use App\Models\Product;
use Illuminate\Http\UploadedFile;

class JsonProductParser implements Parser
{
    public function parse(UploadedFile $file)
    {
        $data = json_decode($file->getContent(), true);

        $products = [];

        foreach ($data['products'] as $product) {
            $products[] = new Product($product);
        }

        return $products;
    }
}

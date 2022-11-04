<?php

namespace App\Http\Services\Product\FileParser;

use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class CsvProductParser implements Parser
{

    public function parse(UploadedFile $file)
    {
        $csvData = str_getcsv($file->getContent(), "\n");
        $headers = explode(',', array_shift($csvData));

        $products = [];

        foreach ($csvData as $product) {
            $product = explode(',', $product);
            $products[] = new Product(array_combine($headers, $product));
        }

        return $products;
    }

}

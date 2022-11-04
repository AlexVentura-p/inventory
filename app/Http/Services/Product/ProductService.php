<?php

namespace App\Http\Services\Product;

use App\Http\Services\Product\FileParser\CsvProductParser;
use App\Http\Services\Product\FileParser\JsonProductParser;
use App\Http\Services\Product\FileParser\Parser;
use App\Http\Services\Product\FileParser\ParserFactory;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\This;

class ProductService
{
    private Parser $parser;

    /**
     * @param Parser $parser
     */
    public function setParser(Parser $parser): void
    {
        $this->parser = $parser;
    }

    public function import(UploadedFile $file): array
    {

        $products = $this->parser->parse($file);

        return array_map(function ($product) {
            return self::store($product);
        }, $products);
    }

    public function store(Product $product): Product
    {
        $product->is_visible = 1;
        $product->save();
        return $product;
    }

}

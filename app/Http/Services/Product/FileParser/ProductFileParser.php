<?php

namespace App\Http\Services\Product\FileParser;


use Illuminate\Http\UploadedFile;

class ProductFileParser
{
    public static function parse(Parser $parser, UploadedFile $data)
    {
        return $parser->parse($data);
    }
}

<?php

namespace App\Http\Services\Product\FileParser;

use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\This;

class ParserFactory
{
    public static function getParser($extension)
    {
        if ($extension == 'json'){
            return new JsonProductParser();
        }

        if ($extension == 'csv'){
            return new CsvProductParser();
        }
    }
}

<?php

namespace App\Http\Services\Product\FileParser;

use Illuminate\Http\UploadedFile;

interface Parser
{
    function parse(UploadedFile $file);
}

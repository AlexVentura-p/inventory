<?php

namespace App\Http\Services\Images;

use App\Jobs\OptimizetImage;

class ImageFormService
{
    public static function store(string $folder,string $image_title)
    {
        if (request()->hasFile('image')) {
            $path = request()->file('image')->storeAs(
                $folder,
                $image_title . '.' . request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            OptimizetImage::dispatch($path);

            return $path;
        }
        return null;
    }
}

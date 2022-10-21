<?php

namespace App\Jobs;

use App\Models\Product;
use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Spatie\LaravelImageOptimizer\ImageOptimizerServiceProvider;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imagePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imagePath)
    {
        $this->imagePath = 'storage/app/public/'.$imagePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageExt = getimagesize($this->imagePath);

        if ($imageExt['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($this->imagePath);
            imagejpeg($image,$this->imagePath,60);
        } else if ($imageExt['mime'] == 'image/png') {
            $image = imagecreatefrompng($this->imagePath);
            imagesavealpha($image,true);
            imagepng($image,$this->imagePath,7);
        }

    }
}

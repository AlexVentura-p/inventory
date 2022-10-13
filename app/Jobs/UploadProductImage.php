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

class UploadProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product_title;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product_title)
    {
        $this->product_title = $product_title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (request()->hasFile('image'))
        {
            $path = request()->file('image')->storeAs(
                'products',
                $this->product_title.'.'.request()->file('image')->getClientOriginalExtension(),
                'public'
            );

            $product = Product::where('title','=',$this->product_title);
            $product->update(['image' => $path]);
        }

    }
}

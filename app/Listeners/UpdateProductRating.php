<?php

namespace App\Listeners;

use App\Events\StoreRatingEvent;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductRating
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\StoreRatingEvent  $event
     * @return void
     */
    public function handle(StoreRatingEvent $event)
    {

        $product = Product::find($event->ratings->product_id);

        $ratings = Rating::where('product_id','=',$event->ratings->product_id);

        $product->rating = $ratings->avg('rating');
        $product->update();

    }
}

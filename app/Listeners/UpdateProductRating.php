<?php

namespace App\Listeners;

use App\Events\StoreRating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductRating
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\StoreRating  $event
     * @return void
     */
    public function handle(StoreRating $event)
    {
        //
    }
}

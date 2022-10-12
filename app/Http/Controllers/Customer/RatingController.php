<?php

namespace App\Http\Controllers\Customer;

use App\Events\StoreRatingEvent;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use http\Env\Request;

class RatingController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'user_id' => ['numeric','required','unique:ratings,user_id,NULL,NULL,product_id,'.
                request('product_id')],
            'product_id' => ['numeric','required','unique:ratings,product_id,NULL,NULL,user_id,'.
                request('user_id')],
            'rating' => ['required','numeric','min:0.01','max:5']
        ]);

        $rating = Rating::create($attributes);

        StoreRatingEvent::dispatch($rating);

        return back()->withInput();

    }
}

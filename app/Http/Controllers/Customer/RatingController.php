<?php

namespace App\Http\Controllers\Customer;

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
            'user_id' => ['required','numeric'],
            'product_id' => ['required','numeric'],
            'rating' => ['required','numeric','min:0.01','max:5']
        ]);

        Rating::create($attributes);

        return back()->withInput();

    }
}

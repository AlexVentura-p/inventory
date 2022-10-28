<?php

namespace Tests\Fakes;

use App\Http\Services\RateConverter\RateConverter;

class FakeEURConverter implements RateConverter
{
    public function convert($amount)
    {
        return [
            'amount' => $amount +1,
            'currency' => 'EUR'
        ];
    }

}

<?php

namespace App\Http\Services\RateConverter;

use Illuminate\Support\Facades\Http;

class ConvertUsdToEur implements RateConverter
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = Config('api_client_auth.EXCHANGE_RATE_TOKEN');
    }

    public function convert($amount)
    {
        $response = Http::withHeaders([
            'apikey'=> $this->apiKey
        ])
            ->get('https://api.apilayer.com/exchangerates_data/convert',[
                'amount' => $amount,
                'from' => 'USD',
                'to' => 'EUR'
            ]);

        return [
            'amount' => $response->json('result'),
            'currency'=>'EUR'
        ];
    }
}

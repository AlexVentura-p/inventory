<?php

namespace App\Http\Services;


use Illuminate\Support\Facades\Http;

class ExchangeRate
{
    public function convertUSDtoEUR($amount)
    {
        $response = Http::withHeaders([
            'apikey'=> Config('api_client_auth.EXCHANGE_RATE_TOKEN')
        ])
            ->get('https://api.apilayer.com/exchangerates_data/convert',[
                'amount' => $amount,
                'from' => 'USD',
                'to' => 'EUR'
            ]);

        return $response->json('result');
    }
}

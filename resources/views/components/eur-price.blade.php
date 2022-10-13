@props([
    /** @var \mixed */
    'order'
])
<td {{ $attributes->class(['text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap']) }}>
    @php
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'apikey'=> Config('api_client_auth.EXCHANGE_RATE_TOKEN')
            ])
        ->get('https://api.apilayer.com/exchangerates_data/convert',[
            'amount' => $order->grand_total,
            'from' => 'USD',
            'to' => 'EUR'
        ]);
    @endphp
    {{$response->json('result')}}</td>

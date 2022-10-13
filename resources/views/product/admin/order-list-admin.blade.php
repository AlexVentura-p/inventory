<x-base-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <h2 class="text-4xl">Orders</h2>
        <table class="min-w-full">
            <thead class="border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Order Id</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Customer Id</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Item count</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Subtotal</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Shipping</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Taxes</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Grand Total</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Grand Total in EUR</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Created at</th>
            </tr>
            </thead>

            @foreach($orders as $order)
                <tbody>
                <tr class="border-b">
                    <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap font-bold">{{$order->id}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$order->user_id}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$order->item_count}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${{$order->sub_total}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${{$order->shipping}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${{$order->taxes}}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${{$order->grand_total}}</td>
                    <x-eur-price :order="$order"/>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$order->created_at}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
        {{$orders->withQueryString()->links()}}
    </main>
</x-base-layout>

<x-base-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <h2 class="text-4xl">Cart</h2>
        <table class="min-w-full">
            <thead class="border-b">
                <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Product</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Quantity</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Unit Price</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Item Total</th>
                </tr>
            </thead>

            @foreach($items_list as $item)
                <tbody>
                    <tr class="border-b">
                        <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap font-bold">{{$item->product->title}}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$item->quantity}}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{$item->unit_price}}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">${{$item->item_total}}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        <form method="POST" action="{{url('/order/store')}}">
            @csrf
            <x-product.form.submit-button name="Confirm order"/>
        </form>

    </main>
</x-base-layout>

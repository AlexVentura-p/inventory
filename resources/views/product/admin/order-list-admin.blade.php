<x-base-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <h2 class="text-4xl">Orders</h2>
        <table class="min-w-full">
            <thead class="border-b">
            <tr>
                <x-order.table.head-col name="Order Id"/>
                <x-order.table.head-col name="Customer Id"/>
                <x-order.table.head-col name="Item count"/>
                <x-order.table.head-col name="Subtotal"/>
                <x-order.table.head-col name="Shipping"/>
                <x-order.table.head-col name="Taxes"/>
                <x-order.table.head-col name="Grand Total"/>
                <x-order.table.head-col name="Grand Total in EUR"/>
                <x-order.table.head-col name="Created at"/>
            </tr>
            </thead>

            @foreach($orders as $order)
                <tbody>
                <tr class="border-b text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <x-order.table.body-col name="{{$order->id}}" class="font-bold"/>
                    <x-order.table.body-col name="{{$order->user_id}}"/>
                    <x-order.table.body-col name="{{$order->item_count}}"/>
                    <x-order.table.body-col name="{{$order->sub_total}} USD"/>
                    <x-order.table.body-col name="{{$order->shipping}} USD"/>
                    <x-order.table.body-col name="{{$order->taxes}} USD"/>
                    <x-order.table.body-col name="{{$order->grand_total}} USD"/>
                    <x-order.table.body-col name="{{$converter->convert($order->grand_total)}} EUR"/>
                    <x-order.table.body-col name="{{$order->created_at}}"/>
                </tr>
                </tbody>
            @endforeach
        </table>
        {{$orders->withQueryString()->links()}}
    </main>
</x-base-layout>

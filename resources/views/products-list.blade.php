<x-layout>
    <x-products-header/>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-10 space-y-6">
        <div class="overflow-x-auto relative">

            <div class="lg:grid lg:grid-cols-3">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <x-product-card :product="$product"/>
                    @endforeach
                @else
                    <span class="text-black-500">No available products found</span>
                @endif
            </div>
            {{$products->withQueryString()->links()}}
        </div>
    </main>
</x-layout>



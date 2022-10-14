<x-base-layout>
    <x-product.products-header :categories="$categories" />
    <main class="max-w-6xl mx-auto mt-6 lg:mt-10 space-y-6">
        <div>
            <a href="{{ url('admin/products/create') }}"
               class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                Create New Product
            </a>
        </div>
        <div class="overflow-x-auto relative">

            <div class="lg:grid lg:grid-cols-3">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <x-product.product-card-admin :product="$product"/>
                    @endforeach
                @else
                    <span class="text-black-500">No available products found</span>
                @endif

            </div>
            {{$products->withQueryString()->links()}}
        </div>
    </main>
</x-base-layout>



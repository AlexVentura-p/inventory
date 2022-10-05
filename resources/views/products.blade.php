<x-layout>
    <header class="max-w mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            <span class="text-blue-500">Products list</span>
        </h1>

        <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
            <form method="GET" action="#">
                <!--  Order by -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">

                        <select name="sortBy"
                                class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                            <option  disabled selected>Sort By
                            </option>
                            <option value="price-desc">Price desc</option>
                            <option value="price">Price asc</option>
                            <option value="title-desc">Title desc</option>
                            <option value="title">Title asc</option>
                        </select>
                    <x-down-arrow/>
                </div>

                <!-- Search -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">

                        <input type="text" name="search" placeholder="Find something"
                               class="bg-transparent placeholder-black font-semibold text-sm">

                </div>
                <!-- Filter by -->
                <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                    <label for="priceRange" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                        Price Range</label>
                    <input name="priceRange" type="range" min="0" max="100">
                </div>
                <button type="submit" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase
                py-3 px-5">
                    Filter
                </button>
            </form>
        </div>
    </header>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <div class="overflow-x-auto relative">

            <div class="lg:grid lg:grid-cols-3">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <x-product-card :product="$product"/>
                    @endforeach
                @else
                    <span class="text-black-500">No available products found</span>
                @endif
                {{$products->links()}}
            </div>

        </div>
    </main>
</x-layout>



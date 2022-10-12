@props(['categories'])
<header {{ $attributes->class(['max-w mx-auto mt-20 text-center']) }}>
    <h1 class="text-4xl">
        <span class="text-blue-500">Products list</span>
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <form method="GET" action="#">

            <!--  Categories -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">

                <select name="category"
                        class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                    <option disabled selected>Category
                    </option>

                    @foreach($categories as $category )
                        <option value="{{$category->name}}"> {{$category->name}} </option>
                    @endforeach
                </select>
                <x-down-arrow/>
            </div>

            <!--  Order by -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">

                <select name="sortBy"
                        class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                    <option disabled selected>Sort By
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

                <input type="text" name="search" placeholder="Search"
                       class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">

            </div>
            <!-- Filter by -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                <label class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                    Price Range</label>
                <input name="minPrice" placeholder="Min price"
                       class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600"
                       type="number" >
                <input name="maxPrice" placeholder="Max price"
                       class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600"
                       type="number">
            </div>
            <button type="submit" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase
                py-3 px-5">
                Filter
            </button>
        </form>
    </div>
</header>

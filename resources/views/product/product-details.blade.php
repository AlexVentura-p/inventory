<x-base-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class=" mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <x-product.image url="{{$product->image}}"/>

            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="{{url("products")}}"
                       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <x-right-arrow/>
                        Back to Product list
                    </a>
                </div>
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{$product->title}}
                </h2>
                <div class="space-y-4 lg:text-lg leading-loose">
                    <p>{{$product->description}}</p>
                </div>
                <div class="space-y-4 lg:text-lg leading-loose">
                    <p><span class="font-bold">Price:</span> ${{$product->unit_price}}</p>
                </div>
                <x-product.categories :product="$product"/>

                @if(!auth()->guest())
                    <x-product.form.edit-rating :product="$product"/>
                @endif
            </div>
        </article>
    </main>
</x-base-layout>

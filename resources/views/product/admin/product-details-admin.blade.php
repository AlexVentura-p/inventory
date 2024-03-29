<x-base-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">

                <x-product.image url="{{$product->image}}"/>

            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="{{url('admin/products')}}"
                       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <x-right-arrow/>
                        Back to Product list
                    </a>
                </div>
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{$product->title}}
                </h2>
                <div class="space-y-4 lg:text-lg leading-loose mb-4">
                    <p>{{$product->description}}</p>
                </div>
                <div class="space-y-4 lg:text-lg leading-loose mb-4">
                    <p><span class="font-bold">Price:</span> ${{$product->unit_price}}</p>
                </div>

                <x-product.categories :product="$product" class="mb-4"/>

                <x-product.rating rating="{{$product->rating}}" class="text-lg mb-4"/>

                <x-product.form.edit-rating :product="$product" class="mb-4"/>

                <div class="space-y-4 lg:text-lg leading-loose flex flex-col mb-4">
                    <p class="font-bold">Status:
                        @if($product->is_visible ==0)
                            <span class="transition-colors duration-300 font-semibold bg-red-200 hover:bg-red-300 rounded-full px-8">
                                No visible
                            </span>
                        @else
                            <span class="transition-colors duration-300 font-semibold bg-green-200 hover:bg-green-300 rounded-full px-8">
                                Visible
                            </span>
                        @endif
                    </p>
                </div>

                <div class="space-y-4 lg:text-lg leading-loose">
                    <a href="{{url('admin/products/'.$product->title.'/edit')}}" >
                        <span class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                             Edit
                        </span>
                    </a>
                </div>
            </div>
        </article>
    </main>
</x-base-layout>

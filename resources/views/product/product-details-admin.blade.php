<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{$product->title}}
                </h2>

            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="{{url('admin/products')}}"
                       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <x-right-arrow/>
                        Back to Product list
                    </a>
                </div>

                <div class="space-y-4 lg:text-lg leading-loose">
                    <p>{{$product->description}}</p>
                </div>
                <div class="space-y-4 lg:text-lg leading-loose">
                    <p><span class="font-bold">Price:</span> ${{$product->unit_price}}</p>
                </div>
                <div class="space-y-4 lg:text-lg leading-loose flex flex-col">
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
                    <a href="{{url('admin/products/manager/edit/'.$product->title)}}" >
                        <span class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                             Edit
                        </span>
                    </a>
                </div>
            </div>
        </article>
    </main>
</x-layout>

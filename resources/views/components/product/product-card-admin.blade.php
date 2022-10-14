<article
        {{ $attributes->class(['transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5 " >

        <div class="mt-4 flex flex-col justify-between">
            <header>

                <div class="mt-2 mb-4">
                    <h1 class="text-3xl">
                        {{$product->title}}
                    </h1>

                </div>
            </header>
            <main class="flex justify-between items-center mt-8">
                <div>
                    <a href="{{ url('admin/products/'.$product->title) }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                        Check info
                    </a>
                </div>

                <div>
                    <form method="POST" action="{{ url('admin/products/'.$product->title)}}">
                        @csrf
                        @method('DELETE')
                        <button class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                                type="submit" >Delete</button>
                    </form>
                </div>
            </main>


            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <div class="ml-3">
                        <h5 class="font-bold">Price: </h5>
                        <h6>${{$product->unit_price}}</h6>
                    </div>
                </div>

                <x-product.rating rating="{{$product->rating}}"/>

                <div class="flex items-center text-sm">
                    <div class="ml-3">
                        <h5 class="font-bold">Status: </h5>
                        @if($product->is_visible ==0)
                            <h6 class="transition-colors duration-300 text-xs font-semibold bg-red-200 hover:bg-red-300 rounded-full py-2 px-8">
                                No visible
                            </h6>
                        @else
                            <h6 class="transition-colors duration-300 text-xs font-semibold bg-green-200 hover:bg-green-300 rounded-full py-2 px-8">
                                Visible
                            </h6>
                        @endif

                    </div>
                </div>


            </footer>
        </div>
    </div>
</article>

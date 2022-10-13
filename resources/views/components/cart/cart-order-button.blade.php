@if (auth()->user()->role == 'customer')
    <a href="{{url("cart")}}" {{ $attributes }}>
        <span class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
            @if(request()->session()->exists('items_list'))
                Cart: {{count(request()->session()->get('items_list'))}}
            @else
                Cart: 0
            @endif
        </span>
    </a>
@elseif(auth()->user()->role == 'admin')
    <a href="{{url("orders")}}" {{ $attributes }}>
            <span class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Check orders
            </span>
    </a>
@endif

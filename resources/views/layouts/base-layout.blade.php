<!doctype html>

<title>Inventory Challenge</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <span class="font-bold text-black-500">Inventory Challenge</span>

            </a>
        </div>

        @if(auth()->guest())
            <form method="GET" action="{{ route('login') }}">
                @csrf
                <div class="mt-8 md:mt-0">
                    <button type="submit">
                            <span class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                                Log in
                            </span>
                    </button>
                </div>
            </form>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="mt-8 md:mt-0">

                        <span class="font-semibold lg:text-center">
                            Hello {{ Auth::user()->first_name}}
                        </span>
                        <a href="{{url("cart")}}">
                            <span class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                                @if(request()->session()->exists('items_list'))
                                    Cart: {{count(request()->session()->get('items_list'))}}
                                @else
                                    Cart: 0
                                @endif
                            </span>
                        </a>
                    <button type="submit">
                            <span class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                                Log out
                            </span>
                    </button>
                </div>
            </form>
        @endif

    </nav>


    {{$slot}}

    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <h5 class="text-3xl">© Inventory Challenge</h5>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

            </div>
        </div>
    </footer>
</section>
</body>

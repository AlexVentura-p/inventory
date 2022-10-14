@props(['product'])
<div {{ $attributes->class(['']) }}>
    <span class="font-bold">Leave rating:</span>
    <form method="POST" action="{{ url('products/ratings/store') }}">
        @csrf
        @if(!auth()->guest())
            <input hidden name="user_id" value="{{auth()->user()->id}}">
        @endif
        <input hidden name="product_id" value="{{$product->id}}">
        <ul class="gap-3 w-full inline-flex">
            <li>
                <input type="radio" id="rating-1" name="rating" value="1" class="peer" required>
                <label for="rating-1" class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">1</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="rating-2" name="rating" value="2" class="peer" required>
                <label for="rating-2" class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">2</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="rating-3" name="rating" value="3" class="peer" required>
                <label for="rating-3" class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">3</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="rating-4" name="rating" value="4" class="peer" required>
                <label for="rating-4" class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">4</div>
                    </div>
                </label>
            </li>
            <li>
                <input type="radio" id="rating-5" name="rating" value="5" class="peer" required>
                <label for="rating-5" class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">5</div>
                    </div>
                </label>
            </li>
            <li>
                <button class="inline-flex justify-between items-center p-2 text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    Submit rating
                </button>
            </li>
        </ul>
    </form>
    <x-validation-errors/>
</div>


@props([
    /** @var \App\Models\Product */
    'product'
])

<div {{ $attributes->class(['space-y-4 lg:text-lg leading-loose']) }}>
    <p><span class="font-bold">Categories:</span>
        @foreach($product->categories as $category)
            {{$category->name}}|
        @endforeach
    </p>
</div>

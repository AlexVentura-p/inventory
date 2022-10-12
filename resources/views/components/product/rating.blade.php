@props(['rating'])

<div {{ $attributes->class(['flex items-center text-sm']) }}>
    <div class="ml-3">
        <h5 class="font-bold">Rating: </h5>
        @if($rating == '')
            <h6>No rating yet</h6>
        @else
            <h6>{{$rating}}</h6>
        @endif
    </div>
</div>

@props(['url'])
@if($url != null)
    <img src="{{asset('storage/'.$url)}}" alt="" {{ $attributes->class(['rounded-xl']) }}>
@endif


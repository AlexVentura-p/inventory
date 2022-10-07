@props(['name','value'])
<div {{ $attributes->class(['mb-4']) }}>
    <label class="block text-gray-700 text-sm font-bold mb-2" for={{$name}}>
        Product Description
    </label>
    @if($value ?? '')
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="{{$name}}"
            name="{{$name}}"
            rows="5"
            placeholder="{{$name}}" required>{{$value}}</textarea>
    @else
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="{{$name}}"
            name="{{$name}}"
            rows="5"
            placeholder="{{$name}}" required>{{old($name)}}</textarea>
    @endif

</div>

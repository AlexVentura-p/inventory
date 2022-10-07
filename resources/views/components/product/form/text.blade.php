@props(['name','value'])
<div {{ $attributes->class(['mb-4']) }}>
    <label class="block text-gray-700 text-sm font-bold mb-2" for={{$name}}>
        Product Title
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
           id="{{$name}}"
           name="{{$name}}"
           type="text"
           placeholder="{{$name}}"
           value=
           @if($value ?? '')
               "{{$value}}"
           @else
               "{{old($name)}}"
           @endif
           required>
</div>

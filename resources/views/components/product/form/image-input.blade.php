@props(['name'])
<div {{ $attributes->class(['relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4']) }}>
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{$name}}">Product image:</label>
    <input type="file" name="{{$name}}">
</div>

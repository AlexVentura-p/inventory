<x-base-layout>
    <x-product.form.basic-template url="{{ url('admin/products/'.$product->title)}}">
        @csrf
        @method('PATCH')
        <x-product.form.text name="title" value="{{$product->title}} "/>

        <x-product.form.textarea name="description" value="{{$product->description}}"/>

        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
            <select name="type"
                    class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                <option disabled selected>
                    Type
                </option>
                @if($product->type == 'RegularProduct')
                    <option value="RegularProduct" selected>Regular Product</option>
                    <option value="DigitalProduct">Digital Product</option>
                @else
                    <option value="RegularProduct">Regular Product</option>
                    <option value="DigitalProduct" selected>Digital Product</option>
                @endif

            </select>
        </div>

        <x-product.form.price name="unit_price" value="{{$product->unit_price}}" />

        <x-product.form.image-input name="image"/>

        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
            <select name="is_visible"
                    class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                <option disabled selected>
                    Visibility
                </option>
                @if($product->is_visible == 0)
                    <option value="0" selected>No visible</option>
                    <option value="1">Visible</option>
                @else
                    <option value="0">No visible</option>
                    <option value="1" selected>Visible</option>
                @endif
            </select>
        </div>
        <x-product.form.submit-button name="Update info"/>
    </x-product.form.basic-template>
</x-base-layout>

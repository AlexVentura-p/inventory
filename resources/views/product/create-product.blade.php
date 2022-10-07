<x-base-layout>
        <x-product.form.basic-template url="{{ url('admin/products/store') }}">
            @csrf
            <x-product.form.text name="title"/>

            <x-product.form.textarea name="description"/>

            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
                <select name="type"
                        class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                    <option disabled selected>
                        Type
                    </option>
                    <option value="RegularProduct">Regular Product</option>
                    <option value="DigitalProduct">Digital Product</option>
                </select>
            </div>

            <x-product.form.price name="unit_price"/>

            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
                <select name="is_visible"
                        class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                    <option disabled selected>
                        Visibility
                    </option>
                    <option value="0">No visible</option>
                    <option value="1">Visible</option>
                </select>
            </div>

            <x-product.form.submit-button name="Create Product"/>

        </x-product.form.basic-template>

</x-base-layout>

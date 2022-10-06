<x-base-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center">
            <div class="w-full max-w-xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form method="POST" action="{{ url('admin/products/store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Product Title
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="title"
                               name="title"
                               type="text"
                               placeholder="title" value="{{old('title')}}"
                                required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Product Description
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="description"
                               name="description"
                               rows="5"
                               placeholder="Description" required>{{old('description')}}</textarea>
                    </div>

                    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
                        <select name="type"
                                class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                            <option disabled selected>Type
                            </option>
                            <option value="RegularProduct">Regular Product</option>
                            <option value="DigitalProduct">Digital Product</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="unit_price">
                            Product Price
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="unit_price"
                               name="unit_price"
                               type="number"
                               step="0.01"
                               min="0.01"
                               placeholder="Price" value="{{old('unit_price')}}" required>
                    </div>

                    <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl border-gray-900 mb-4">
                        <select name="is_visible"
                                class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold " required>
                            <option disabled selected>Visibility
                            </option>
                            <option value="0">No visible</option>
                            <option value="1">Visible</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                            Create Product
                        </button>
                    </div>

                </form>
                <x-validation-errors class="mb-4" :errors="$errors" />
            </div>
        </div>
</x-base-layout>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add Exhaust Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            {{-- Name --}}
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Product Name')" />
                                <x-text-input class="mt-1 block w-full" id="name" name="name" type="text"
                                    :value="old('name')" required autofocus
                                    placeholder="{{ __('Example: Proliner TR-1') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Category --}}
                            <div class="md:col-span-2">
                                <x-input-label for="category_id" :value="__('Category')" />
                                <x-select-input class="mt-1 block w-full" id="category_id" name="category_id" required>
                                    <x-slot name="options">
                                        <option value="" disabled selected>{{ __('-- Select Category --') }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </x-slot>
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            {{-- Price --}}
                            <div>
                                <x-input-label for="price" :value="__('Price (Rp)')" />
                                <x-text-input class="mt-1 block w-full" id="price" name="price" type="number"
                                    :value="old('price')" required min="0"
                                    placeholder="{{ __('Example: 1500000') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            {{-- Stock --}}
                            <div>
                                <x-input-label for="stock" :value="__('Stock Quantity')" />
                                <x-text-input class="mt-1 block w-full" id="stock" name="stock" type="number"
                                    :value="old('stock', 0)" required min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                            </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Product Description')" />
                                <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    id="description" name="description" rows="4" required
                                    placeholder="{{ __('Describe the exhaust specifications...') }}">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Image --}}
                            <div class="md:col-span-2">
                                <x-input-label for="image" :value="__('Product Photo (Optional)')" />
                                <input
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-gray-800 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700"
                                    id="image" name="image" type="file" accept="image/*" />
                                <p class="mt-1 text-xs text-gray-500">{{ __('Formats: JPG, PNG, WEBP. Max: 2MB.') }}
                                </p>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.products.index') }}">
                                <x-secondary-button type="button">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Save Product') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

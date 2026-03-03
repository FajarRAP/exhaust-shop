<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Exhaust Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">

                    <form method="POST" action="{{ route('admin.products.update', $product) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            {{-- Name --}}
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Product Name')" />
                                <x-text-input class="mt-1 block w-full" id="name" name="name" type="text"
                                    :value="old('name', $product->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Category --}}
                            <div class="md:col-span-2">
                                <x-input-label for="category_id" :value="__('Category')" />
                                <x-select-input class="mt-1 block w-full" id="category_id" name="category_id" required>
                                    <x-slot name="options">
                                        <option value="" disabled>{{ __('-- Select Category --') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                    :value="old('price', $product->price)" required min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            {{-- Stock Quantity --}}
                            <div>
                                <x-input-label for="stock" :value="__('Stock Quantity')" />
                                <x-text-input class="mt-1 block w-full" id="stock" name="stock" type="number"
                                    :value="old('stock', $product->stock)" required min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                            </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Product Description')" />
                                <x-textarea class="mt-1 block w-full" id="description" name="description" rows="4"
                                    required>{{ old('description', $product->description) }}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Image --}}
                            <div class="md:col-span-2">
                                <x-input-label for="image" :value="__('Change Product Photo (Optional)')" />

                                @if ($product->image)
                                    <div class="mb-3 mt-2">
                                        <p class="mb-1 text-sm text-gray-600">{{ __('Current Photo:') }}</p>
                                        <img class="h-32 w-32 rounded-md border border-gray-200 object-cover shadow-sm"
                                            src="{{ $product->publicImageUrl() }}" alt="{{ $product->name }}"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'view-product-image')">
                                    </div>

                                    <x-modal name="view-product-image" focusable>
                                        <div class="p-6">
                                            <div class="mb-4 flex items-center justify-between">
                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Product Photo Preview') }}
                                                </h2>
                                                <button class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                                    type="button"
                                                    x-on:click="$dispatch('close-modal', 'view-product-image')">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="flex justify-center">
                                                <img class="max-h-[70vh] max-w-full rounded-md object-contain shadow-sm"
                                                    src="{{ $product->publicImageUrl() }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    </x-modal>
                                @endif

                                <x-file-input class="mt-1 block w-full" id="image" name="image" type="file"
                                    accept="image/*" />
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ __('Leave blank if you do not want to change the photo.') }}
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
                                {{ __('Update Product') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

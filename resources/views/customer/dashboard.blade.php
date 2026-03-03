<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Exhaust Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ product: {} }">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse ($products as $product)
                    <a href="{{ route('customer.products.show', ['slug' => $product->slug]) }}">
                        <div
                            class="flex flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm transition-shadow hover:shadow-md">
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                                @if ($product->image)
                                    <img class="h-48 w-full object-cover object-center"
                                        src="{{ $product->publicImageUrl() }}" alt="{{ $product->name }}"
                                        x-on:click.prevent="
                                    product = {{ json_encode(['name' => $product->name, 'image' => $product->publicImageUrl()]) }}
                                    $dispatch('open-modal', 'view-product-image')">
                                @else
                                    <div class="flex h-48 w-full items-center justify-center bg-gray-100 text-gray-400">
                                        {{ __('No Image') }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-1 flex-col p-4">
                                <h3 class="text-sm font-medium text-gray-900">{{ $product->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $product->category->name ?? __('No Category') }}
                                </p>

                                <div class="mt-auto flex items-center justify-between pt-4">
                                    <p class="text-lg font-bold text-gray-900">{{ $product->priceDisplay() }}
                                    </p>
                                </div>

                                <div class="mt-4">
                                    @if ($product->stock > 0)
                                        <form action="{{ route('customer.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <x-primary-button class="capitalize! w-full justify-center">
                                                {{ __('Add to Cart') }}
                                            </x-primary-button>
                                        </form>
                                    @else
                                        <button
                                            class="w-full cursor-not-allowed rounded-md bg-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-500"
                                            disabled>
                                            {{ __('Out of Stock') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-lg bg-white py-12 text-center text-gray-500 shadow-sm">
                        {{ __('No exhaust products are available for sale at the moment.') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links('components.pagination.pagination') }}
            </div>
        </div>

        <x-modal name="view-product-image" focusable>
            <div class="p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Product Photo') }}
                    </h2>
                    <button class="text-gray-400 hover:text-gray-500 focus:outline-none" type="button"
                        x-on:click="$dispatch('close')">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="flex justify-center">
                    <img class="max-h-[70vh] max-w-full rounded-md object-contain shadow-sm"
                        x-bind:src="product.image" x-bind:alt="product.name">
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>

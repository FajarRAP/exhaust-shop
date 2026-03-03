<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-sm font-medium">
            <a class="text-gray-500 transition hover:text-gray-700"
                href="{{ route('customer.dashboard') }}">{{ __('Catalog') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-800">{{ $product->name }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 p-6 text-gray-900 md:p-8">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-12">
                        <div>
                            @if ($product->image)
                                <img class="h-auto w-full rounded-xl border border-gray-100 object-cover shadow-md"
                                    src="{{ $product->publicImageUrl() }}" alt="{{ $product->name }}">
                            @else
                                <div
                                    class="flex aspect-square w-full items-center justify-center rounded-xl bg-gray-100 text-gray-400">
                                    {{ __('No Image Available') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <span
                                class="text-sm font-bold uppercase tracking-wider text-indigo-600">{{ $product->category->name ?? __('No Category') }}</span>
                            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                {{ $product->name }}</h1>
                            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $product->priceDisplay() }}</p>

                            <form class="mt-8 border-t border-gray-100 pt-8" action="#" method="POST">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->id }}">

                                <div class="flex items-end space-x-4">
                                    <div>
                                        <x-input-label for="quantity" :value="__('Quantity')" />
                                        <x-text-input class="mt-1 block w-24 text-center" id="quantity" name="quantity"
                                            type="number" value="1" min="1" max="{{ $product->stock }}"
                                            required />
                                    </div>
                                    <div class="flex-1">
                                        @if ($product->isStockEmpty())
                                            <button
                                                class="w-full cursor-not-allowed rounded-md bg-gray-300 py-3 font-semibold text-gray-500"
                                                type="button" disabled>
                                                {{ __('Out of Stock') }}
                                            </button>
                                        @else
                                            <x-primary-button class="w-full justify-center py-3 text-base">
                                                {{ __('Add to Cart') }}
                                            </x-primary-button>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">{{ __('Remaining stock:') }} <span
                                        class="font-bold text-gray-800">{{ $product->stock }}</span>
                                    {{ __('units') }}</p>
                            </form>

                            <div class="mt-10">
                                <h3 class="mb-4 text-lg font-bold text-gray-900">{{ __('Product Description') }}</h3>
                                <div class="prose prose-sm leading-relaxed text-gray-600">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">{{ __('Similar Products') }}</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($relatedProducts as $product)
                            <x-products.related-product :$product :href="route('customer.products.show', ['slug' => $product->slug])" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

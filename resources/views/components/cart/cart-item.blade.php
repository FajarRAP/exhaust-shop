@props(['cart'])

<div class="flex flex-col gap-6 border-b border-gray-50 pb-6 last:border-0 last:pb-0 sm:flex-row sm:items-center">
    <div class="h-32 w-full shrink-0 overflow-hidden rounded-lg border border-gray-200 bg-gray-100 sm:w-32">
        @if ($cart->product->image)
            <img class="h-full w-full object-cover" src="{{ $cart->product->publicImageUrl() }}"
                alt="{{ $cart->product->name }}">
        @else
            <div class="flex h-full w-full items-center justify-center text-xs text-gray-400">
                {{ __('No Image') }}</div>
        @endif
    </div>

    <div class="flex-1">
        <a class="text-lg font-bold text-gray-900 transition hover:text-indigo-600"
            href="{{ route('customer.products.show', ['slug' => $cart->product->slug]) }}">
            {{ $cart->product->name }}
        </a>
        <p class="mb-2 text-sm font-semibold text-indigo-600">
            {{ $cart->product->category->name ?? __('No Category') }}</p>
        <p class="font-medium text-gray-600">
            {{ $cart->product->priceDisplay() }}
            <span class="text-xs font-normal text-gray-400">{{ __('/ unit') }}</span>
        </p>
    </div>

    <div class="min-w-35 flex items-center justify-between gap-4 sm:flex-col sm:items-end sm:justify-center">
        <div class="text-left sm:text-right">
            <p class="mb-1 text-xs text-gray-400">{{ __('Subtotal') }}</p>
            <p class="text-lg font-bold text-gray-900">
                {{ Number::currency($cart->product->price * $cart->quantity, 'IDR', locale: 'id_ID', precision: 0) }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="rounded-md border border-gray-200 bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-700">
                {{ __('Qty:') }} {{ $cart->quantity }}
            </span>

            <form action="{{ route('customer.cart.destroy', $cart->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="rounded-md bg-red-50 p-2 text-red-500 transition hover:bg-red-100 hover:text-red-700"
                    type="submit" onclick="return confirm('{{ __('Remove this item from cart?') }}')">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

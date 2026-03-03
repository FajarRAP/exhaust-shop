<div class="mx-auto max-w-md text-center">
    <svg class="mx-auto size-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
        </path>
    </svg>

    <h2 class="mt-6 text-2xl font-bold text-gray-900">{{ __('Your cart is empty') }}</h2>

    <p class="mt-4 text-pretty text-gray-700">
        {{ __('It seems you haven\'t added your dream exhaust to the cart yet. Start browsing now!') }}
    </p>

    <div class="mt-6 space-y-2">
        <a class="block rounded-lg border border-gray-300 bg-white p-4 text-left transition-colors hover:bg-gray-50"
            href="{{ route('customer.dashboard') }}">
            <h3 class="font-medium text-gray-900">{{ __('Exhaust Collection') }}</h3>
            <p class="mt-1 text-sm text-gray-600">{{ __('Browse our curated selection') }}</p>
        </a>
    </div>

    <a class="mt-6 block w-full rounded-lg bg-indigo-600 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-indigo-700"
        href="{{ route('customer.dashboard') }}">
        {{ __('See Catalog') }}
    </a>
</div>

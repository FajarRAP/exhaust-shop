<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 flex items-center rounded-lg bg-green-50 p-4 text-sm text-green-800 shadow-sm">
                    <svg class="me-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ __('Success!') }}</span>&nbsp;{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-center rounded-lg bg-red-50 p-4 text-sm text-red-800 shadow-sm">
                    <svg class="me-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ __('Failed!') }}</span>&nbsp;{{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col gap-8 lg:flex-row">
                <div class="flex-1">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 md:p-8">
                            <h3 class="mb-6 border-b border-gray-100 pb-4 text-xl font-bold">
                                {{ __('Items in Cart') }} ({{ $cartsCount }})
                            </h3>

                            <div class="space-y-6">
                                @forelse ($carts as $cart)
                                    <x-cart.cart-item :$cart />
                                @empty
                                    <x-cart.cart-empty />
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @if ($cartsCount > 0)
                    <div class="w-full lg:w-1/3">
                        <div class="sticky top-8 border border-gray-100 bg-white p-6 shadow-sm sm:rounded-lg">
                            <h3 class="mb-6 border-b border-gray-100 pb-4 text-lg font-bold text-gray-900">
                                {{ __('Order Summary') }}</h3>

                            <div class="mb-6 space-y-4">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>{{ __('Total Items') }}</span>
                                    <span class="font-medium text-gray-900">{{ $carts->sum('quantity') }}
                                        {{ __('items') }}</span>
                                </div>

                                <div
                                    class="mt-4 flex justify-between border-t border-gray-100 pt-4 text-xl font-extrabold text-gray-900">
                                    <span>{{ __('Total Price') }}</span>
                                    <span>{{ Number::currency($totalPrice, 'IDR', locale: 'id_ID', precision: 0) }}</span>
                                </div>
                            </div>

                            <form action="#" method="POST">
                                @csrf
                                <x-primary-button class="w-full justify-center px-4 py-3.5" type="submit">
                                    {{ __('Proceed to Checkout') }}
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </x-primary-button>
                            </form>

                            <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-500">
                                <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <span>{{ __('Your Payment is Secured by Midtrans') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

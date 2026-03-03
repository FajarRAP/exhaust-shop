<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Exhaust Shop Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-green-100 p-3 text-green-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Revenue This Month') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">Rp 0</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-yellow-100 p-3 text-yellow-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Pending Orders') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">0</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Products') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts ?? 100 }}</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-purple-100 p-3 text-purple-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Categories') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalCategories ?? 20 }}</p>
                    </div>
                </div>

            </div>

            <div
                class="mt-8 overflow-hidden border border-gray-100 bg-white p-6 text-center text-gray-500 shadow-sm sm:rounded-lg">
                <p>{{ __('Order history table will appear here once the transaction module is implemented.') }}</p>
            </div>

        </div>
    </div>
</x-admin-layout>

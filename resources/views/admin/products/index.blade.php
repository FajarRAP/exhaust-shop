<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Exhaust Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-sm text-green-800 shadow-sm"
                    role="alert">
                    <svg class="me-3 inline h-4 w-4 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="font-medium">{{ __('Success!') }}</span>&nbsp;{{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between border-b border-gray-200 p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __('Product Data') }}</h3>

                    <a href="{{ route('admin.products.create') }}">
                        <x-primary-button>
                            {{ __('+ Add Product') }}
                        </x-primary-button>
                    </a>
                </div>

                <div class="p-6">
                    <div class="relative overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                        <x-tables.product-table :$products />
                    </div>

                    {{ $products->links('components.pagination.pagination') }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

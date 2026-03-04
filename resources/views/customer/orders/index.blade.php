<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden border border-gray-100 bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <x-tables.order-table :$orders />
                        </div>
                    @else
                        <div class="py-12 text-center text-gray-500">
                            {{ __('You have no orders yet.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

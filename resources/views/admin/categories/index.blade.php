<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Exhaust Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}">
                <x-primary-button>
                    {{ __('+ Add Category') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="relative mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="relative mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto p-6 text-gray-900">
                    <x-tables.category-table :$categories />

                    {{ $categories->links('components.pagination.pagination') }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

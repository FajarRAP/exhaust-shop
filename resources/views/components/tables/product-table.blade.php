@props(['products' => []])

<x-table>
    <x-slot name="headers">
        <tr>
            <th class="w-16 px-6 py-3" scope="col">{{ __('No') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Image') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Product Name') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Category') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Price') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Stock') }}</th>
            <th class="px-6 py-3 text-center" scope="col">{{ __('Actions') }}</th>
        </tr>
    </x-slot>

    <x-slot name="content">
        @forelse ($products as $product)
            <tr class="border-b bg-white transition duration-150 hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ $products->firstItem() + $loop->index }}
                </td>

                <td class="px-6 py-4">
                    @if ($product->image)
                        <img class="h-16 w-16 rounded object-cover shadow-sm"
                            src="{{ $product->publicImageUrl() }}"alt="{{ $product->name }}">
                    @else
                        <div
                            class="flex h-16 w-16 items-center justify-center rounded bg-gray-100 text-xs text-gray-500 shadow-sm">
                            {{ __('No Image') }}
                        </div>
                    @endif
                </td>

                <td class="px-6 py-4 font-medium text-gray-900">
                    {{ $product->name }}
                </td>

                <td class="px-6 py-4">
                    <span
                        class="me-2 rounded border border-gray-500 bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                        {{ $product->category->name ?? __('No Category') }}
                    </span>
                </td>

                <td class="whitespace-nowrap px-6 py-4 text-gray-900">
                    {{ $product->priceDisplay() }}
                </td>

                <td class="px-6 py-4">
                    @if ($product->isStockEmpty())
                        <span class="font-bold text-red-600">{{ __('Out of Stock') }}</span>
                    @else
                        <span class="font-bold text-green-600">{{ $product->stock }}</span>
                    @endif
                </td>

                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}">
                            <x-warning-button>
                                {{ __('Edit') }}
                            </x-warning-button>
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}');">
                            @csrf
                            @method('DELETE')

                            <x-danger-button>
                                {{ __('Delete') }}
                            </x-danger-button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-6 py-8 text-center text-gray-500" colspan="7">
                    <x-empty-data :href="route('admin.products.create')" />
                </td>
            </tr>
        @endforelse
    </x-slot>
</x-table>

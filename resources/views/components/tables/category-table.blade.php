@props(['categories'])

<x-table>
    <x-slot name="headers">
        <tr>
            <th class="w-16 px-6 py-3" scope="col">{{ __('No') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Category Name') }}</th>
            <th class="px-6 py-3" scope="col">{{ __('Slug') }}</th>
            <th class="px-6 py-3 text-center" scope="col">{{ __('Actions') }}</th>
        </tr>
    </x-slot>

    <x-slot name="content">
        @forelse ($categories as $category)
            <tr class="border-b bg-white transition duration-150 hover:bg-gray-50">
                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                    {{ $category->name }}
                </td>
                <td class="px-6 py-4">
                    <span
                        class="me-2 rounded border border-gray-500 bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                        {{ $category->slug }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}">
                            <x-warning-button>
                                {{ __('Edit') }}
                            </x-warning-button>
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}');">
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
                <td class="px-6 py-8 text-center text-gray-500" colspan="4">
                    <x-empty-data :href="route('admin.categories.create')" />
                </td>
            </tr>
        @endforelse
    </x-slot>
</x-table>

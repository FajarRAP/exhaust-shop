@props(['href' => '#'])

<div class="mx-auto max-w-md text-center">
    <svg class="mx-auto size-20 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125">
        </path>
    </svg>

    <h2 class="mt-6 text-2xl font-bold text-gray-900">{{ __('No data to display') }}</h2>

    <p class="mt-4 text-pretty text-gray-700">
        {{ __('Get started by creating your first item. It only takes a few seconds.') }}
    </p>

    <div class="mt-6 space-y-3">
        <a href="{{ $href }}">
            <x-primary-button>
                {{ __('Create New') }}
            </x-primary-button>
        </a>
    </div>
</div>

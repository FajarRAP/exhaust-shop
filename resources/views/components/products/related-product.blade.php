@props(['href', 'product'])

<a class="group block overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm transition-all duration-200 hover:border-indigo-100 hover:shadow-lg"
    href="{{ $href }}">
    <div class="aspect-w-4 aspect-h-3 w-full overflow-hidden bg-gray-200">
        @if ($product->image)
            <img class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105"
                src="{{ $product->publicImageUrl() }}" alt="{{ $product->name }}">
        @else
            <div class="flex h-48 w-full items-center justify-center bg-gray-100 text-gray-400">
                {{ __('No Image') }}</div>
        @endif
    </div>
    <div class="p-5">
        <h3 class="text-md line-clamp-1 font-semibold text-gray-900 group-hover:text-indigo-600">
            {{ $product->name }}</h3>
        <p class="mt-2 text-lg font-bold text-gray-900">{{ $product->priceDisplay() }}</p>
    </div>
</a>

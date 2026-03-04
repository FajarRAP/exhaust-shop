@props(['orders'])

<table class="w-full text-left text-sm text-gray-500">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700">
        <tr>
            <th class="px-6 py-4" scope="col">{{ __('Invoice Number') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Date') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Total Price') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Status') }}</th>
            <th class="px-6 py-4 text-center" scope="col">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr class="border-b bg-white hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-gray-900">
                    {{ $order->invoice_number }}
                </td>
                <td class="px-6 py-4">
                    {{ $order->created_at->locale('id_ID')->format('d M Y H:i') }}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900">
                    {{ Number::currency($order->total_price, 'IDR', locale: 'id_ID', precision: 0) }}
                </td>
                <td class="px-6 py-4">
                    <x-orders.status-badge :status="$order->status" />
                </td>
                <td class="px-6 py-4 text-center">
                    <a class="font-semibold text-indigo-600 hover:text-indigo-900"
                        href="{{ route('customer.orders.show', $order->invoice_number) }}">
                        {{ __('View Details') }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@props(['orders'])

<table class="w-full text-left text-sm text-gray-500">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700">
        <tr>
            <th class="px-6 py-4" scope="col">{{ __('Invoice') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Customer') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Total') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Date') }}</th>
            <th class="px-6 py-4" scope="col">{{ __('Status') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr class="border-b bg-white hover:bg-gray-50">
                <td class="px-6 py-4 font-bold text-gray-900">{{ $order->invoice_number }}</td>
                <td class="px-6 py-4">{{ $order->user->name }}</td>
                <td class="px-6 py-4 font-semibold text-gray-900">
                    {{ formatCurrency($order->total_price) }}</td>
                <td class="px-6 py-4">
                    {{ todMYHi($order->created_at) }}</td>
                <td class="px-6 py-4">
                    <x-orders.status-badge :status="$order->status" />
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-6 py-4 text-center text-gray-500" colspan="5">
                    {{ __('No transactions yet.') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Order Details') }} #{{ $order->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 flex items-center rounded-lg bg-green-50 p-4 text-sm text-green-800 shadow-sm">
                    <span class="font-medium">{{ __('Success!') }}</span>&nbsp;{{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden border border-gray-100 bg-white p-6 shadow-sm sm:rounded-lg">

                <div
                    class="mb-6 flex flex-col items-start justify-between border-b border-gray-100 pb-6 md:flex-row md:items-center">
                    <div>
                        <p class="mb-1 text-sm text-gray-500">{{ __('Transaction Date:') }}
                            {{ $order->created_at->locale('id_ID')->format('d F Y H:i') }}</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $order->invoice_number }}</h3>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <x-orders.status-badge class="font-bold! px-4 py-2" :status="$order->status" />
                    </div>
                </div>

                <h4 class="mb-4 font-bold text-gray-900">{{ __('Order Items') }}</h4>
                <div class="mb-8 space-y-4">
                    @foreach ($order->orderDetails as $detail)
                        <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $detail->product_name }}</p>
                                <p class="text-sm text-gray-500">{{ $detail->quantity }} x
                                    {{ Number::currency($detail->price, 'IDR', locale: 'id_ID', precision: 0) }}</p>
                            </div>
                            <div class="font-bold text-gray-900">
                                {{ Number::currency($detail->price * $detail->quantity, 'IDR', locale: 'id_ID', precision: 0) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-col items-center justify-between rounded-lg bg-gray-50 p-6 md:flex-row">
                    <div>
                        <p class="text-sm text-gray-500">{{ __('Order Total') }}</p>
                        <p class="text-3xl font-extrabold text-indigo-600">
                            {{ Number::currency($order->total_price, 'IDR', locale: 'id_ID', precision: 0) }}</p>
                    </div>

                    <div class="mt-6 md:mt-0">
                        @if ($order->status == 'pending' && $order->snap_token)
                            <x-primary-button class="rounded-lg px-8 py-3 font-bold text-white shadow-lg transition"
                                id="pay-button">
                                {{ __('Pay Now') }}
                            </x-primary-button>
                        @elseif($order->status == 'pending' && !$order->snap_token)
                            <p class="text-sm text-red-500">{{ __('Waiting for Midtrans Token...') }}</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if ($order->status == 'pending' && $order->snap_token)
        @push('head-scripts')
            <script type="text/javascript" src={{ env('MIDTRANS_SNAP_JS_URL') }}
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        @endpush

        @push('body-scripts')
            <script type="text/javascript">
                const payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    snap.pay('{{ $order->snap_token }}', {
                        onSuccess: function(result) {
                            alert("{{ __('Payment successful!') }}");
                            window.location.reload();
                        },
                        onPending: function(result) {
                            alert("{{ __('Waiting for your payment.') }}");
                        },
                        onError: function(result) {
                            alert("{{ __('Payment failed!') }}");
                        },
                        onClose: function() {
                            console.log('User closed the payment popup without completing the payment');
                        }
                    });
                });
            </script>
        @endpush
    @endif
</x-app-layout>

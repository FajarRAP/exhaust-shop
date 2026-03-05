<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Exhaust Shop Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-green-100 p-3 text-green-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Revenue This Month') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ formatCurrency($currentMonthRevenue) }}</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-yellow-100 p-3 text-yellow-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Pending Orders') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingOrdersCount }}</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Customers') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalCustomers }}</p>
                    </div>
                </div>

                <div class="flex items-center overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="rounded-full bg-purple-100 p-3 text-purple-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Products') }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm lg:col-span-2">
                    <h3 class="mb-4 text-lg font-bold text-gray-900">{{ __('Revenue Last 7 Days') }}</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-bold text-gray-900">{{ __('Overall Order Status') }}</h3>
                    <div class="relative flex h-72 w-full items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

            </div>

            <div class="overflow-hidden border border-gray-100 bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900">{{ __('Recent Transactions') }}</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <x-tables.customer-order-table :orders="$recentOrders" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('body-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const last7Days = @json($last7Days);
            const revenue7Days = @json($revenue7Days);
            const statusData = @json($orderStatusData);

            // 1. Revenue Chart
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: last7Days,
                    datasets: [{
                        label: @json(__('Revenue (IDR)')),
                        data: revenue7Days,
                        borderColor: 'rgb(79, 70, 229)',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });

            // 2. Order Status Chart
            const donutLabels = statusData.map(e => e.label);
            const donutData = statusData.map(e => e.value);
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: donutLabels,
                    datasets: [{
                        data: donutData,
                        backgroundColor: [
                            'rgb(34, 197, 94)', // Paid: Green 500
                            'rgb(234, 179, 8)', // Pending: Yellow 500
                            'rgb(239, 68, 68)', // Failed: Red 500
                            'rgb(249, 115, 22)', // Expired: Orange 500
                            'rgb(107, 114, 128)' // Cancelled: Gray 500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>

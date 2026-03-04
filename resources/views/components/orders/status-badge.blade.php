@props(['status'])

@php
    $badgeClass = '';
    $text = '';

    switch ($status) {
        case 'pending':
            $badgeClass = 'bg-yellow-50 text-yellow-800 ring-yellow-600/20';
            $text = __('Pending Payment');
            break;
        case 'paid':
            $badgeClass = 'bg-green-50 text-green-700 ring-green-600/20';
            $text = __('Paid');
            break;
        case 'cancelled':
            $badgeClass = 'bg-red-50 text-red-700 ring-red-600/10';
            $text = __('Cancelled');
        case 'expired':
            $badgeClass = 'bg-red-50 text-red-700 ring-red-600/10';
            $text = __('Expired');
            break;
        default:
            break;
    }
@endphp

<span
    {{ $attributes->merge(['class' => "$badgeClass inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset"]) }}>{{ $text }}</span>

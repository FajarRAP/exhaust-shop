<?php

use Illuminate\Support\Number;

if (!function_exists('formatCurrency')) {
    function formatCurrency(int|float $amount, string $currency = 'IDR', string $locale = 'id_ID', int $precision = 0): string
    {
        return Number::currency($amount, $currency, locale: $locale, precision: $precision);
    }
}

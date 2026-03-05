<?php

use Carbon\Carbon;

if (!function_exists('todMYHi')) {
    function todMYHi(DateTime $date, String $locale = 'id_ID', String $timezone = 'Asia/Jakarta'): string
    {
        return Carbon::parse($date)
            ->locale($locale)
            ->timezone($timezone)
            ->format('d M Y, H:i');
    }
}

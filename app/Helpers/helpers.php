<?php

if (!function_exists('fmt_num')) {
    function fmt_num(?float $value, int $decimals = 2): string
    {
        return $value !== null
            ? number_format($value, $decimals, ',', '.')
            : '—';
    }
}
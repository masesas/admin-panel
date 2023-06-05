<?php

/*
 *
 * Return Date with weekday
 *
 * ------------------------------------------------------------------------
 */
if (!function_exists('date_today')) {

    /**
     * Return Date with weekday.
     *
     * Carbon Locale will be considered here
     * Example:
     * শুক্রবার, ২৪ জুলাই ২০২০
     * Friday, July 24, 2020
     */
    function date_today() {
        $str = \Carbon\Carbon::now()->isoFormat('dddd, LL');

        return $str;
    }
}

if (!function_exists('format_rupiah')) {

    /**
     * Return Date with weekday.
     *
     * Carbon Locale will be considered here
     * Example:
     * শুক্রবার, ২৪ জুলাই ২০২০
     * Friday, July 24, 2020
     */
    function format_rupiah($value) {
        return "Rp. " . number_format($value, 0, ',', '.');
    }
}

if (!function_exists('format_date_spell')) {

    /**
     * Return Date with weekday.
     *
     * Carbon Locale will be considered here
     * Example:
     * শুক্রবার, ২৪ জুলাই ২০২০
     * Friday, July 24, 2020
     */
    function format_date_spell() {
        $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
        $str = \Carbon\Carbon::now()->isoFormat('dddd, LL');

        return $str;
    }
}

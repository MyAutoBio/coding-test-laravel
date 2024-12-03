<?php

if (!function_exists('getBgColor')) {
    function getColorClass(string $color, string $grade, bool $typeIsBg = true): string
    {
        return ($typeIsBg ? 'bg' : 'text') . "-$color-$grade";
    }
}

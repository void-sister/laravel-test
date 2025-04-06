<?php

if (!function_exists('format_truthy_value')) {
    /**
     * Format a value that may be boolean-like (1/0, true/false, "true"/"false")
     * into a human-readable "yes" or "no" string. If not boolean-like, return as-is.
     *
     * @param mixed $value
     * @param string $true  Custom string for true values
     * @param string $false Custom string for false values
     * @return string
     */
    function format_truthy_value(mixed $value, string $true = 'yes', string $false = 'no'): string
    {
        $boolean = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return $boolean !== null
            ? ($boolean ? $true : $false)
            : (string) $value;
    }
}

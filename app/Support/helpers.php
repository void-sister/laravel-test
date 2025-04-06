<?php

use Illuminate\Support\Str;

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

if (!function_exists('parse_domain')) {
    /**
     * Parse a domain from a URL or string. If the input is not a valid domain,
     * return null.
     *
     * @param string $input
     * @return string|null
     */
    function parse_domain(string $input): ?string
    {
        $input = Str::of($input)->trim()->lower();

        if (!Str::startsWith($input, ['http://', 'https://'])) {
            $input = Str::of('http://')->append($input);
        }

        $host = Str::of(parse_url($input, PHP_URL_HOST));

        if ($host->isEmpty()) {
            return null;
        }

        $host = $host->startsWith('www.')
            ? $host->after('www.')
            : $host;

        return filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
            ? $host->toString()
            : null;
    }
}

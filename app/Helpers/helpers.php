<?php

if (!function_exists('format_price')) {
    function format_price(float $price, string $currency = 'MAD'): string
    {
        return number_format($price, 2, ',', ' ') . ' ' . $currency;
    }
}

if (!function_exists('active_locale')) {
    function active_locale(): string
    {
        return app()->getLocale();
    }
}

if (!function_exists('seo_title')) {
    function seo_title(string $title = ''): string
    {
        $siteName = config('app.name', 'Gestion Formations');
        return $title ? $title . ' | ' . $siteName : $siteName;
    }
}


if (!function_exists('status_badge')) {
    function status_badge(string $status): string
    {
        $badges = [
            'brouillon'  => '<span class="badge bg-secondary">Brouillon</span>',
            'publié'     => '<span class="badge bg-success">Publié</span>',
            'archivé'    => '<span class="badge bg-warning">Archivé</span>',
            'en attente' => '<span class="badge bg-warning">En attente</span>',
            'confirmée'  => '<span class="badge bg-success">Confirmée</span>',
            'annulée'    => '<span class="badge bg-danger">Annulée</span>',
        ];

        return $badges[$status] ?? '<span class="badge bg-secondary">' . $status . '</span>';
    }
}


if (!function_exists('get_setting')) {
    function get_setting(string $key, mixed $default = null): mixed
    {
        return config($key, $default);
    }
}

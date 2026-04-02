<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FormaPro') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-4">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-block">
                <span class="text-2xl font-bold text-gray-900">Forma<span class="text-blue-600">Pro</span></span>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
            {{ $slot }}
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} FormaPro. Tous droits réservés.
        </p>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ active_locale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ seo_title($title ?? '') }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}">
</head>
<body>
    <header>
        <h1><a href="/">Gestion Formations</a></h1>
        <nav>
            <a href="{{ route('public.formations', ['locale' => active_locale()]) }}">
                {{ active_locale() == 'fr' ? 'Formations' : 'Trainings' }}
            </a>
            <a href="{{ route('public.blog', ['locale' => active_locale()]) }}">Blog</a>
            <a href="{{ route('public.contact', ['locale' => active_locale()]) }}">Contact</a>
            <a href="{{ route('public.home', ['locale' => 'fr']) }}">FR</a>
            <a href="{{ route('public.home', ['locale' => 'en']) }}">EN</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Gestion Formations</p>
    </footer>
</body>
</html>

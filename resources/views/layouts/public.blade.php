<!DOCTYPE html>
<html lang="{{ active_locale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($seoTitle) ? seo_title($seoTitle) : seo_title() }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <meta property="og:title" content="{{ isset($seoTitle) ? seo_title($seoTitle) : seo_title() }}">
    <meta property="og:description" content="{{ $metaDescription ?? '' }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

            <a href="{{ route('public.home', ['locale' => active_locale()]) }}"
                class="text-lg font-bold text-gray-900 tracking-tight">
                Forma<span class="text-blue-600">Pro</span>
            </a>

            <nav aria-label="Menu principal" class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="{{ route('public.formations', ['locale' => active_locale()]) }}"
                    class="{{ request()->routeIs('public.formations*') ? 'text-blue-600 border-b-2 border-blue-600 pb-0.5' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ active_locale() === 'fr' ? 'Formations' : 'Trainings' }}
                </a>
                <a href="{{ route('public.blog', ['locale' => active_locale()]) }}"
                    class="{{ request()->routeIs('public.blog*') ? 'text-blue-600 border-b-2 border-blue-600 pb-0.5' : 'text-gray-600 hover:text-gray-900' }}">
                    Blog
                </a>
                <a href="{{ route('public.contact', ['locale' => active_locale()]) }}"
                    class="{{ request()->routeIs('public.contact*') ? 'text-blue-600 border-b-2 border-blue-600 pb-0.5' : 'text-gray-600 hover:text-gray-900' }}">
                    Contact
                </a>
            </nav>

            <div class="flex items-center gap-3 text-sm">
                {{-- Language switcher --}}
                <div class="flex items-center border border-gray-200 rounded-md overflow-hidden text-xs font-medium">
                    <a href="{{ route('public.home', ['locale' => 'fr']) }}"
                        class="px-2.5 py-1.5 {{ active_locale() === 'fr' ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-50' }}">
                        FR
                    </a>
                    <a href="{{ route('public.home', ['locale' => 'en']) }}"
                        class="px-2.5 py-1.5 {{ active_locale() === 'en' ? 'bg-blue-600 text-white' : 'text-gray-500 hover:bg-gray-50' }} border-l border-gray-200">
                        EN
                    </a>
                </div>

                @auth
                <a href="{{ route('admin.dashboard') }}"
                    class="text-xs bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition font-medium">
                    {{ active_locale() === 'fr' ? 'Administration' : 'Admin' }}
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="text-xs bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    {{ active_locale() === 'fr' ? 'Connexion' : 'Login' }}
                </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-400 mt-16">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <div>
                    <p class="text-white font-bold text-lg mb-1">Forma<span class="text-blue-400">Pro</span></p>
                    <p class="text-sm text-gray-500">{{ active_locale() === 'fr' ? 'Plateforme de formation professionnelle' : 'Professional training platform' }}</p>
                </div>
                <nav aria-label="Liens du pied de page" class="flex gap-8 text-sm">
                    <a href="{{ route('public.formations', ['locale' => active_locale()]) }}" class="hover:text-white transition">
                        {{ active_locale() === 'fr' ? 'Formations' : 'Trainings' }}
                    </a>
                    <a href="{{ route('public.blog', ['locale' => active_locale()]) }}" class="hover:text-white transition">Blog</a>
                    <a href="{{ route('public.contact', ['locale' => active_locale()]) }}" class="hover:text-white transition">Contact</a>
                </nav>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-xs text-gray-600">
                &copy; {{ date('Y') }} FormaPro. {{ active_locale() === 'fr' ? 'Tous droits réservés.' : 'All rights reserved.' }}
            </div>
        </div>
    </footer>

</body>

</html>
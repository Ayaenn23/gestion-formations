<!DOCTYPE html>
<html lang="{{ active_locale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ seo_title($title ?? 'Admin') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-56 bg-gray-900 flex flex-col flex-shrink-0">

        {{-- Logo --}}
        <div class="h-14 flex items-center gap-3 px-5 border-b border-gray-700">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1" fill="white"/>
                    <rect x="8" y="1" width="5" height="5" rx="1" fill="white" opacity="0.5"/>
                    <rect x="1" y="8" width="5" height="5" rx="1" fill="white" opacity="0.5"/>
                    <rect x="8" y="8" width="5" height="5" rx="1" fill="white"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-white">Admin Panel</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 py-4 overflow-y-auto">

            <p class="px-5 mb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Navigation</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-5 py-2.5 text-sm font-medium
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <rect x="1" y="1" width="6" height="6" rx="1.5" fill="currentColor" opacity="0.9"/>
                    <rect x="9" y="1" width="6" height="6" rx="1.5" fill="currentColor" opacity="0.4"/>
                    <rect x="1" y="9" width="6" height="6" rx="1.5" fill="currentColor" opacity="0.4"/>
                    <rect x="9" y="9" width="6" height="6" rx="1.5" fill="currentColor" opacity="0.9"/>
                </svg>
                Dashboard
            </a>

            <p class="px-5 mt-5 mb-2 text-[10px] font-semibold text-gray-500 uppercase tracking-widest">Gestion</p>

            @foreach([
                ['admin.users.index', 'Utilisateurs', 'M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z'],
                ['admin.categories.index', 'Catégories', 'M7 7h.01M7 3h5a2 2 0 012 2v5a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2zm-4 0h.01M3 3h.01M3 7h.01M3 11h.01'],
                ['admin.formations.index', 'Formations', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['admin.sessions.index', 'Sessions', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['admin.enrollments.index', 'Inscriptions', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['admin.posts.index', 'Blog', 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
            ] as [$route, $label, $icon])
            <a href="{{ route($route) }}"
               class="flex items-center gap-3 px-5 py-2.5 text-sm
                      {{ request()->routeIs($route) ? 'bg-blue-600 text-white font-medium' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="flex-shrink-0">
                    <path d="{{ $icon }}" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ $label }}
            </a>
            @endforeach

        </nav>

        {{-- Footer --}}
        <div class="border-t border-gray-700 p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left text-xs text-gray-500 hover:text-white px-2 py-1 rounded hover:bg-gray-800 transition">
                    → Déconnexion
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- HEADER --}}
        <header class="h-14 bg-white border-b border-gray-200 flex items-center justify-between px-6 flex-shrink-0">
            <h1 class="text-base font-semibold text-gray-800">{{ $pageTitle ?? 'Dashboard' }}</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('public.home', ['locale' => 'fr']) }}"
                   class="text-xs text-gray-500 border border-gray-200 px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition">
                    ↗ Voir le site
                </a>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6">

            @if(session('success'))
            <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg flex items-center gap-2">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>

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
    <aside class="w-52 bg-white border-r border-gray-200 flex flex-col flex-shrink-0">
        <div class="h-13 flex items-center gap-2 px-4 border-b border-gray-200" style="height:52px">
            <div class="w-7 h-7 rounded-md bg-blue-600 flex items-center justify-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1" fill="white"/>
                    <rect x="8" y="1" width="5" height="5" rx="1" fill="white" opacity="0.6"/>
                    <rect x="1" y="8" width="5" height="5" rx="1" fill="white" opacity="0.6"/>
                    <rect x="8" y="8" width="5" height="5" rx="1" fill="white"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-800">Gestion Formations</span>
        </div>

        <nav class="flex-1 py-3 overflow-y-auto">
            <p class="px-3 mb-1 text-[10px] font-medium text-gray-400 uppercase tracking-wider">Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 mx-2 px-3 py-1.5 rounded-lg text-sm
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1" fill="currentColor" opacity="0.9"/>
                    <rect x="8" y="1" width="5" height="5" rx="1" fill="currentColor" opacity="0.4"/>
                    <rect x="1" y="8" width="5" height="5" rx="1" fill="currentColor" opacity="0.4"/>
                    <rect x="8" y="8" width="5" height="5" rx="1" fill="currentColor" opacity="0.9"/>
                </svg>
                Dashboard
            </a>

            <p class="px-3 mt-4 mb-1 text-[10px] font-medium text-gray-400 uppercase tracking-wider">Gestion</p>

            @foreach([
                ['admin.users.index', 'Utilisateurs'],
                ['admin.categories.index', 'Catégories'],
                ['admin.formations.index', 'Formations'],
                ['admin.sessions.index', 'Sessions'],
                ['admin.enrollments.index', 'Inscriptions'],
                ['admin.posts.index', 'Blog'],
            ] as [$route, $label])
            <a href="{{ route($route) }}"
               class="flex items-center gap-2 mx-2 px-3 py-1.5 rounded-lg text-sm
                      {{ request()->routeIs($route) ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                <span class="w-1 h-1 rounded-full bg-current opacity-50"></span>
                {{ $label }}
            </a>
            @endforeach

            <p class="px-3 mt-4 mb-1 text-[10px] font-medium text-gray-400 uppercase tracking-wider">Compte</p>
            <form method="POST" action="{{ route('logout') }}" class="mx-2">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-gray-600 hover:bg-gray-100 text-left">
                    <span class="w-1 h-1 rounded-full bg-current opacity-50"></span>
                    Déconnexion
                </button>
            </form>
        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- HEADER --}}
        <header class="h-13 bg-white border-b border-gray-200 flex items-center justify-between px-5 flex-shrink-0" style="height:52px">
            <div>
                <h1 class="text-sm font-medium text-gray-800">{{ $pageTitle ?? 'Dashboard' }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('public.home', ['locale' => 'fr']) }}"
                   class="text-xs text-gray-500 border border-gray-200 px-2.5 py-1 rounded-full hover:bg-gray-50">
                    Site public
                </a>
                <span class="text-xs text-gray-400">{{ auth()->user()->name }}</span>
                <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-xs font-medium text-blue-700">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-5">

            @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg">
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

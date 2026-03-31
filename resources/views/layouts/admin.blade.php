<!DOCTYPE html>
<html lang="{{ active_locale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ seo_title('Admin') }}</title>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Gestion Formations - Admin</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </header>

    <!-- Contenu de la page -->
    <main>
        @yield('content')
    </main>

</body>
</html>

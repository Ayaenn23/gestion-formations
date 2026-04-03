<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accès refusé</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-red-500">403</h1>
        <h2 class="text-3xl font-semibold text-white mt-4">Accès refusé</h2>
        <p class="text-gray-400 mt-2">Vous n'avez pas les permissions pour accéder à cette page.</p>
        <a href="{{ url('/admin/dashboard') }}"
           class="mt-6 inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg">
            Retour au Dashboard
        </a>
    </div>
</body>
</html>

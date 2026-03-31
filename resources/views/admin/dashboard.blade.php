<!DOCTYPE html>
<html>
<head>
    <title>{{ seo_title('Dashboard') }}</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Bienvenue {{ auth()->user()->name }}</p>
</body>
</html>

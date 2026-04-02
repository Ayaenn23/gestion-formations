@extends('layouts.admin')
@section('content')
    <h1>Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}">Ajouter</a>
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif

    <table border="1">
        <tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Statut</th><th>Actions</th></tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->getRoleNames()->join(', ') }}</td>
            <td>{{ $user->is_active ? 'Actif' : 'Inactif' }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user) }}">Modifier</a>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

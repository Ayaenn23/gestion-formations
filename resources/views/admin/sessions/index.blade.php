@extends('layouts.admin')
@section('content')
    <h1>Sessions</h1>
    <a href="{{ route('admin.sessions.create') }}">Ajouter</a>
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif

    <table border="1">
        <tr><th>Formation</th><th>Formateur</th><th>Début</th><th>Fin</th><th>Mode</th><th>Statut</th><th>Actions</th></tr>
        @foreach($sessions as $session)
        <tr>
            <td>{{ $session->formation->titre_fr }}</td>
            <td>{{ $session->trainer->name }}</td>
            <td>{{ $session->start_date }}</td>
            <td>{{ $session->end_date }}</td>
            <td>{{ $session->mode->value }}</td>
            <td>{{ $session->statut }}</td>
            <td>
                <a href="{{ route('admin.sessions.edit', $session) }}">Modifier</a>
                <form method="POST" action="{{ route('admin.sessions.destroy', $session) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

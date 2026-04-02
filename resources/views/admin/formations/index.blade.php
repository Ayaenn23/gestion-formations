@extends('layouts.admin')
@section('content')
    <h1>Formations</h1>
    <a href="{{ route('admin.formations.create') }}">Ajouter</a>
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif

    <table border="1">
        <tr><th>Titre FR</th><th>Catégorie</th><th>Prix</th><th>Statut</th><th>Actions</th></tr>
        @foreach($formations as $formation)
        <tr>
            <td>{{ $formation->titre_fr }}</td>
            <td>{{ $formation->category->name_fr }}</td>
            <td>{{ $formation->prix ? format_price($formation->prix) : '-' }}</td>
            <td>{!! status_badge($formation->statut->value) !!}</td>
            <td>
                <a href="{{ route('admin.formations.edit', $formation) }}">Modifier</a>
                <form method="POST" action="{{ route('admin.formations.destroy', $formation) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

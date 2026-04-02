@extends('layouts.admin')
@section('content')
    <h1>Articles</h1>
    <a href="{{ route('admin.posts.create') }}">Ajouter</a>
    @if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif

    <table border="1">
        <tr><th>Titre FR</th><th>Catégorie</th><th>Auteur</th><th>Statut</th><th>Actions</th></tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title_fr }}</td>
            <td>{{ $post->category->name_fr }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->statut }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post) }}">Modifier</a>
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

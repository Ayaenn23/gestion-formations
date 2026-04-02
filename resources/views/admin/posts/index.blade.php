@extends('layouts.admin')

@php $pageTitle = 'Articles'; @endphp

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-lg font-bold text-gray-900">Articles</h2>
        <p class="text-sm text-gray-500 mt-0.5">Gérez le contenu de votre blog</p>
    </div>
    <a href="{{ route('admin.posts.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        Ajouter
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre FR</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Auteur</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Publication</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5 font-semibold text-gray-800">{{ $post->title_fr }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $post->category?->name_fr ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $post->author?->name ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">
                    {{ $post->publication_date ? \Carbon\Carbon::parse($post->publication_date)->format('d/m/Y') : '—' }}
                </td>
                <td class="px-5 py-3.5">{!! status_badge($post->statut ?? 'brouillon') !!}</td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Modifier</a>
                        <span class="text-gray-200">|</span>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cet article ?')"
                                    class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                    <p class="text-sm">Aucun article enregistré.</p>
                    <a href="{{ route('admin.posts.create') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Rédiger le premier →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

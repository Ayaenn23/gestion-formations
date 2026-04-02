@extends('layouts.admin')

@php $pageTitle = 'Formations'; @endphp

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-lg font-bold text-gray-900">Formations</h2>
        <p class="text-sm text-gray-500 mt-0.5">Gérez toutes vos formations</p>
    </div>
    <a href="{{ route('admin.formations.create') }}"
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
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Durée</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($formations as $formation)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5 font-semibold text-gray-800">{{ $formation->titre_fr }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $formation->category?->name_fr ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $formation->prix ? format_price($formation->prix) : '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $formation->duree ?? '—' }}</td>
                <td class="px-5 py-3.5">{!! status_badge($formation->statut?->value ?? 'brouillon') !!}</td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.formations.edit', $formation) }}"
                           class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Modifier</a>
                        <span class="text-gray-200">|</span>
                        <form method="POST" action="{{ route('admin.formations.destroy', $formation) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette formation ?')"
                                    class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" class="mx-auto mb-3 text-gray-300"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    <p class="text-sm">Aucune formation enregistrée.</p>
                    <a href="{{ route('admin.formations.create') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Ajouter la première →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

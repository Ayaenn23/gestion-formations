@extends('layouts.admin')

@php $pageTitle = 'Catégories'; @endphp

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-lg font-bold text-gray-900">Catégories</h2>
        <p class="text-sm text-gray-500 mt-0.5">Organisez vos formations par catégorie</p>
    </div>
    <a href="{{ route('admin.categories.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        Ajouter
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom FR</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom EN</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug FR</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug EN</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5 font-semibold text-gray-800">{{ $category->name_fr }}</td>
                <td class="px-5 py-3.5 text-gray-600">{{ $category->name_en }}</td>
                <td class="px-5 py-3.5">
                    <code class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-mono">{{ $category->slug_fr }}</code>
                </td>
                <td class="px-5 py-3.5">
                    <code class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-mono">{{ $category->slug_en }}</code>
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Modifier</a>
                        <span class="text-gray-200">|</span>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette catégorie ?')"
                                    class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                    <p class="text-sm">Aucune catégorie enregistrée.</p>
                    <a href="{{ route('admin.categories.create') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Ajouter la première →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

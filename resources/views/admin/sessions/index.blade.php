@extends('layouts.admin')

@php $pageTitle = 'Sessions'; @endphp

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-lg font-bold text-gray-900">Sessions</h2>
        <p class="text-sm text-gray-500 mt-0.5">Planifiez et gérez les sessions de formation</p>
    </div>
    <a href="{{ route('admin.sessions.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        Ajouter
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Formation</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Formateur</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Début</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fin</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mode</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ville</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($sessions as $session)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5 font-semibold text-gray-800">{{ $session->formation?->titre_fr ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $session->trainer?->name ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ \Carbon\Carbon::parse($session->start_date)->format('d/m/Y H:i') }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ \Carbon\Carbon::parse($session->end_date)->format('d/m/Y H:i') }}</td>
                <td class="px-5 py-3.5">{!! status_badge($session->mode?->value ?? '') !!}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $session->ville ?? '—' }}</td>
                <td class="px-5 py-3.5">{!! status_badge($session->statut ?? '') !!}</td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.sessions.edit', $session) }}"
                           class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Modifier</a>
                        <span class="text-gray-200">|</span>
                        <form method="POST" action="{{ route('admin.sessions.destroy', $session) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette session ?')"
                                    class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                    <p class="text-sm">Aucune session enregistrée.</p>
                    <a href="{{ route('admin.sessions.create') }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Planifier la première →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

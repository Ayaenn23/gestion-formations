@extends('layouts.admin')

@php $pageTitle = 'Dashboard'; @endphp

@section('content')

{{-- Welcome --}}
<div class="mb-6">
    <p class="text-gray-500 text-sm">Bienvenue, <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span> — voici un résumé de votre plateforme.</p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-4 gap-4 mb-8">
    @foreach([
        ['Formations', \App\Models\Formation::count(), 'bg-blue-50 text-blue-700', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['Sessions', \App\Models\TrainingSession::count(), 'bg-indigo-50 text-indigo-700', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['Inscriptions', \App\Models\Enrollment::count(), 'bg-amber-50 text-amber-700', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
        ['Utilisateurs', \App\Models\User::count(), 'bg-green-50 text-green-700', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
    ] as [$label, $count, $colors, $icon])
    <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4">
        <div class="w-11 h-11 {{ $colors }} rounded-xl flex items-center justify-center flex-shrink-0">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                <path d="{{ $icon }}" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 mb-0.5">{{ $label }}</p>
            <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- Dernières formations --}}
<div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-sm font-semibold text-gray-800">Dernières formations</h2>
        <a href="{{ route('admin.formations.index') }}" class="text-xs text-blue-600 hover:underline font-medium">Voir tout →</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix</th>
                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse(\App\Models\Formation::with('category')->latest()->take(5)->get() as $f)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5 font-medium text-gray-800">{{ $f->titre_fr }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $f->category?->name_fr ?? '—' }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ format_price($f->prix ?? 0) }}</td>
                <td class="px-5 py-3.5">{!! status_badge($f->statut?->value ?? 'brouillon') !!}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-5 py-8 text-center text-gray-400 text-sm">Aucune formation enregistrée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

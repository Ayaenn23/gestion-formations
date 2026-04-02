@extends('layouts.admin')

@php $pageTitle = 'Dashboard'; @endphp

@section('content')

<p class="text-sm text-gray-500 mb-5">Bienvenue, {{ auth()->user()->name }}</p>

{{-- Cartes de stats --}}
<div class="grid grid-cols-4 gap-3 mb-6">
    @foreach([
        ['Formations', \App\Models\Formation::count(), 'text-blue-700'],
        ['Sessions', \App\Models\TrainingSession::count(), 'text-teal-700'],
        ['Inscriptions', \App\Models\Enrollment::count(), 'text-amber-700'],
        ['Utilisateurs', \App\Models\User::count(), 'text-red-700'],
    ] as [$label, $count, $color])
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-xs font-medium text-gray-500 mb-1">{{ $label }}</p>
        <p class="text-2xl font-medium {{ $color }}">{{ $count }}</p>
    </div>
    @endforeach
</div>

{{-- Table dernières formations --}}
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
        <span class="text-sm font-medium text-gray-800">Dernières formations</span>
        <a href="{{ route('admin.formations.index') }}" class="text-xs text-blue-600 hover:underline">Voir tout</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-2 text-xs font-medium text-gray-500">Titre</th>
                <th class="text-left px-4 py-2 text-xs font-medium text-gray-500">Catégorie</th>
                <th class="text-left px-4 py-2 text-xs font-medium text-gray-500">Prix</th>
                <th class="text-left px-4 py-2 text-xs font-medium text-gray-500">Statut</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach(\App\Models\Formation::with('category')->latest()->take(5)->get() as $f)
            <tr>
                <td class="px-4 py-2.5 text-gray-800">{{ $f->titre_fr }}</td>
                <td class="px-4 py-2.5 text-gray-500">{{ $f->category->name_fr }}</td>
                <td class="px-4 py-2.5 text-gray-500">{{ format_price($f->prix ?? 0) }}</td>
                <td class="px-4 py-2.5">
                    @php
                        $colors = ['publié'=>'bg-green-50 text-green-700','brouillon'=>'bg-amber-50 text-amber-700','archivé'=>'bg-gray-100 text-gray-600'];
                        $v = $f->statut->value;
                    @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $colors[$v] ?? 'bg-gray-100 text-gray-600' }}">{{ $v }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

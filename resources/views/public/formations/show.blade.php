@extends('layouts.public')
@php
    $seoTitle = $formation->{'seo_title_' . active_locale()}
                ?? $formation->{'titre_' . active_locale()};
    $metaDescription = $formation->{'seo_description_' . active_locale()}
                       ?? $formation->{'description_courte_' . active_locale()};
@endphp
@section('content')

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-4">
        <nav aria-label="Fil d'ariane" class="text-xs text-gray-400 flex items-center gap-2">
            <a href="{{ route('public.formations', ['locale' => active_locale()]) }}" class="hover:text-blue-600 transition">
                {{ active_locale() === 'fr' ? 'Formations' : 'Trainings' }}
            </a>
            <span>/</span>
            <span class="text-gray-600 font-medium">{{ $formation->{'titre_' . active_locale()} }}</span>
        </nav>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-3 gap-10">

        {{-- Contenu principal --}}
        <div class="col-span-2">
            @if($formation->image)
                <img src="{{ asset('storage/' . $formation->image) }}"
                     alt="{{ $formation->{'titre_' . active_locale()} }}"
                     class="w-full h-72 object-cover rounded-xl mb-8 shadow-sm">
            @endif

            @if($formation->category)
                <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wide mb-3">
                    {{ $formation->category->{'name_' . active_locale()} }}
                </span>
            @endif

            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                {{ $formation->{'titre_' . active_locale()} }}
            </h1>

            <p class="text-gray-600 leading-relaxed mb-8 text-base border-l-4 border-blue-200 pl-4">
                {{ $formation->{'description_courte_' . active_locale()} }}
            </p>

            @if($formation->{'description_complete_' . active_locale()})
            <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($formation->{'description_complete_' . active_locale()})) !!}
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">

            {{-- Carte prix et inscription --}}
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm sticky top-24">
                <p class="text-3xl font-bold text-gray-900 mb-1">{{ format_price($formation->prix ?? 0) }}</p>
                <p class="text-xs text-gray-400 mb-5">{{ active_locale() === 'fr' ? 'Prix par participant' : 'Price per participant' }}</p>

                <div class="space-y-3 text-sm text-gray-600 border-t border-gray-100 pt-4 mb-5">
                    @if($formation->duree)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 flex items-center gap-1.5">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            {{ active_locale() === 'fr' ? 'Durée' : 'Duration' }}
                        </span>
                        <span class="font-medium text-gray-800">{{ $formation->duree }}</span>
                    </div>
                    @endif
                    @if($formation->niveau)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 flex items-center gap-1.5">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M2 20h4V10H2v10zm7 0h4V4H9v16zm7 0h4v-6h-4v6z" fill="currentColor" opacity="0.6"/></svg>
                            {{ active_locale() === 'fr' ? 'Niveau' : 'Level' }}
                        </span>
                        <span class="font-medium text-gray-800">{{ ucfirst($formation->niveau) }}</span>
                    </div>
                    @endif
                </div>

                <a href="{{ route('public.contact', ['locale' => active_locale()]) }}"
                   class="block w-full text-center bg-blue-600 text-white font-semibold text-sm px-4 py-3 rounded-lg hover:bg-blue-700 transition">
                    {{ active_locale() === 'fr' ? "S'inscrire maintenant" : 'Register now' }}
                </a>
                <a href="{{ route('public.contact', ['locale' => active_locale()]) }}"
                   class="block w-full text-center text-gray-500 text-xs mt-2 hover:text-gray-700">
                    {{ active_locale() === 'fr' ? 'Une question ? Contactez-nous' : 'A question? Contact us' }}
                </a>
            </div>

            {{-- Sessions --}}
            @if($formation->trainingSessions->count())
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">
                    {{ active_locale() === 'fr' ? 'Sessions disponibles' : 'Available sessions' }}
                </p>
                <div class="space-y-3">
                    @foreach($formation->trainingSessions as $session)
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($session->start_date)->format('d/m/Y') }}
                            → {{ \Carbon\Carbon::parse($session->end_date)->format('d/m/Y') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ ucfirst($session->mode?->value ?? '') }}
                            @if($session->ville) — {{ $session->ville }}@endif
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

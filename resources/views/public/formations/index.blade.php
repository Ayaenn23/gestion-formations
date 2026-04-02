@extends('layouts.public')

@section('content')

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">
            {{ active_locale() === 'fr' ? 'Toutes les formations' : 'All trainings' }}
        </h1>
        <p class="text-gray-500 text-sm">
            {{ $formations->count() }} {{ active_locale() === 'fr' ? 'formation(s) disponible(s)' : 'training(s) available' }}
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($formations as $f)
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition group">
            @if($f->image)
                <img src="{{ asset('storage/' . $f->image) }}" alt="{{ $f->{'titre_' . active_locale()} }}"
                     class="w-full h-48 object-cover group-hover:opacity-95 transition">
            @else
                <div class="w-full h-48 bg-blue-50 flex items-center justify-center">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="text-blue-200">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            @endif
            <div class="p-5">
                @if($f->category)
                    <span class="text-xs text-blue-600 font-semibold uppercase tracking-wide">{{ $f->category->{'name_' . active_locale()} }}</span>
                @endif
                <h2 class="text-sm font-bold text-gray-900 mt-1 mb-2">{{ $f->{'titre_' . active_locale()} }}</h2>
                <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $f->{'description_courte_' . active_locale()} }}</p>

                @if($f->duree || $f->niveau)
                <div class="flex items-center gap-4 text-xs text-gray-400 mb-4">
                    @if($f->duree)
                        <span class="flex items-center gap-1">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            {{ $f->duree }}
                        </span>
                    @endif
                    @if($f->niveau)
                        <span class="flex items-center gap-1">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24"><path d="M2 20h4V10H2v10zm7 0h4V4H9v16zm7 0h4v-6h-4v6z" fill="currentColor"/></svg>
                            {{ ucfirst($f->niveau) }}
                        </span>
                    @endif
                </div>
                @endif

                <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                    <span class="text-base font-bold text-gray-900">{{ format_price($f->prix ?? 0) }}</span>
                    <a href="{{ route('public.formations.show', ['locale' => active_locale(), 'slug' => $f->{'slug_' . active_locale()}]) }}"
                       class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition font-medium">
                        {{ active_locale() === 'fr' ? 'Voir' : 'View' }}
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20 text-gray-400">
            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" class="mx-auto mb-3 text-gray-300"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <p class="text-sm">{{ active_locale() === 'fr' ? 'Aucune formation disponible.' : 'No trainings available.' }}</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

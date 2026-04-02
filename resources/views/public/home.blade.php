@extends('layouts.public')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white">
    <div class="max-w-6xl mx-auto px-6 py-24 text-center">
        <span class="inline-block text-xs font-semibold bg-blue-600 text-blue-100 px-3 py-1 rounded-full uppercase tracking-wider mb-5">
            {{ active_locale() === 'fr' ? 'Plateforme de formation professionnelle' : 'Professional training platform' }}
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-5 leading-tight">
            {{ active_locale() === 'fr' ? 'Développez vos compétences' : 'Develop your skills' }}
        </h1>
        <p class="text-blue-200 text-lg max-w-2xl mx-auto mb-8">
            {{ active_locale() === 'fr'
                ? 'Découvrez nos formations professionnelles et boostez votre carrière avec des experts reconnus.'
                : 'Discover our professional training courses and boost your career with recognized experts.' }}
        </p>
        <a href="{{ route('public.formations', ['locale' => active_locale()]) }}"
           class="inline-block bg-white text-blue-700 font-semibold px-8 py-3 rounded-lg text-sm hover:bg-blue-50 transition shadow-lg">
            {{ active_locale() === 'fr' ? 'Voir toutes les formations' : 'Browse all trainings' }}
        </a>
    </div>
</section>

{{-- Formations récentes --}}
<section class="max-w-6xl mx-auto px-6 py-16">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                {{ active_locale() === 'fr' ? 'Formations récentes' : 'Recent trainings' }}
            </h2>
            <p class="text-gray-500 text-sm mt-1">{{ active_locale() === 'fr' ? 'Nos dernières formations disponibles' : 'Our latest available trainings' }}</p>
        </div>
        <a href="{{ route('public.formations', ['locale' => active_locale()]) }}"
           class="text-sm text-blue-600 font-medium hover:underline">
            {{ active_locale() === 'fr' ? 'Voir tout →' : 'View all →' }}
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($formations as $f)
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition group">
            @if($f->image)
                <img src="{{ asset('storage/' . $f->image) }}" alt="{{ $f->{'titre_' . active_locale()} }}"
                     class="w-full h-44 object-cover group-hover:opacity-95 transition">
            @else
                <div class="w-full h-44 bg-blue-50 flex items-center justify-center">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="text-blue-200">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            @endif
            <div class="p-5">
                @if($f->category)
                    <span class="text-xs text-blue-600 font-semibold uppercase tracking-wide">{{ $f->category->{'name_' . active_locale()} }}</span>
                @endif
                <h3 class="text-sm font-bold text-gray-900 mt-1 mb-2">{{ $f->{'titre_' . active_locale()} }}</h3>
                <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $f->{'description_courte_' . active_locale()} }}</p>
                <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                    <span class="text-base font-bold text-gray-900">{{ format_price($f->prix ?? 0) }}</span>
                    <a href="{{ route('public.formations.show', ['locale' => active_locale(), 'slug' => $f->{'slug_' . active_locale()}]) }}"
                       class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition font-medium">
                        {{ active_locale() === 'fr' ? 'En savoir plus' : 'Learn more' }}
                    </a>
                </div>
            </div>
        </div>
        @empty
            <p class="col-span-3 text-center text-gray-400 text-sm py-12">
                {{ active_locale() === 'fr' ? 'Aucune formation disponible.' : 'No trainings available.' }}
            </p>
        @endforelse
    </div>
</section>

{{-- Articles récents --}}
@if($posts->count())
<section class="bg-gray-50 border-t border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-16">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ active_locale() === 'fr' ? 'Derniers articles' : 'Latest articles' }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">{{ active_locale() === 'fr' ? 'Conseils et actualités' : 'Tips and news' }}</p>
            </div>
            <a href="{{ route('public.blog', ['locale' => active_locale()]) }}"
               class="text-sm text-blue-600 font-medium hover:underline">
                {{ active_locale() === 'fr' ? 'Voir tout →' : 'View all →' }}
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <div class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md transition">
                @if($post->category)
                    <span class="text-xs text-blue-600 font-semibold uppercase tracking-wide">{{ $post->category->{'name_' . active_locale()} }}</span>
                @endif
                <h3 class="text-sm font-bold text-gray-900 mt-2 mb-3">{{ $post->{'title_' . active_locale()} }}</h3>
                <p class="text-xs text-gray-400 mb-4">{{ $post->author?->name ?? '' }}</p>
                <a href="{{ route('public.blog.show', ['locale' => active_locale(), 'slug' => $post->{'slug_' . active_locale()}]) }}"
                   class="text-xs text-blue-600 font-medium hover:underline">
                    {{ active_locale() === 'fr' ? 'Lire l\'article →' : 'Read article →' }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

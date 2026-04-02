@extends('layouts.public')

@section('content')

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-1">Blog</h1>
        <p class="text-gray-500 text-sm">
            {{ active_locale() === 'fr' ? 'Conseils, actualités et ressources' : 'Tips, news and resources' }}
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($posts as $post)
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition group">
            <div class="p-5">
                @if($post->category)
                    <span class="text-xs text-blue-600 font-semibold uppercase tracking-wide">{{ $post->category->{'name_' . active_locale()} }}</span>
                @endif
                <h2 class="text-sm font-bold text-gray-900 mt-2 mb-3 group-hover:text-blue-600 transition">
                    {{ $post->{'title_' . active_locale()} }}
                </h2>
                <div class="flex items-center gap-2 text-xs text-gray-400 mb-5">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg>
                    <span>{{ $post->author?->name ?? '—' }}</span>
                    @if($post->publication_date)
                        <span>·</span>
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span>{{ \Carbon\Carbon::parse($post->publication_date)->format('d/m/Y') }}</span>
                    @endif
                </div>
                <a href="{{ route('public.blog.show', ['locale' => active_locale(), 'slug' => $post->{'slug_' . active_locale()}]) }}"
                   class="inline-block text-xs bg-blue-50 text-blue-600 font-semibold px-3 py-1.5 rounded-lg hover:bg-blue-100 transition">
                    {{ active_locale() === 'fr' ? 'Lire l\'article →' : 'Read article →' }}
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20 text-gray-400">
            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" class="mx-auto mb-3 text-gray-300"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <p class="text-sm">{{ active_locale() === 'fr' ? 'Aucun article publié.' : 'No articles published.' }}</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

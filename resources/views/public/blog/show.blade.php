@extends('layouts.public')
@php
    $seoTitle = $post->{'seo_title_' . active_locale()}
                ?? $post->{'title_' . active_locale()};
    $metaDescription = $post->{'meta_description_' . active_locale()}
                       ?? '';
@endphp
@section('content')

<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-3xl mx-auto px-6 py-4">
        <nav aria-label="Fil d'ariane" class="text-xs text-gray-400 flex items-center gap-2">
            <a href="{{ route('public.blog', ['locale' => active_locale()]) }}" class="hover:text-blue-600 transition">Blog</a>
            <span>/</span>
            <span class="text-gray-600 font-medium">{{ $post->{'title_' . active_locale()} }}</span>
        </nav>
    </div>
</div>

<div class="max-w-3xl mx-auto px-6 py-12">

    @if($post->category)
        <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wide mb-4">
            {{ $post->category->{'name_' . active_locale()} }}
        </span>
    @endif

    <h1 class="text-3xl font-bold text-gray-900 mt-2 mb-4 leading-tight">
        {{ $post->{'title_' . active_locale()} }}
    </h1>

    <div class="flex items-center gap-4 text-sm text-gray-400 mb-8 pb-6 border-b border-gray-200">
        <span class="flex items-center gap-1.5">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg>
            {{ $post->author?->name ?? '—' }}
        </span>
        @if($post->publication_date)
            <span class="flex items-center gap-1.5">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                {{ \Carbon\Carbon::parse($post->publication_date)->format('d M Y') }}
            </span>
        @endif
    </div>

    <article class="text-gray-700 leading-relaxed text-base space-y-4">
        {!! nl2br(e($post->{'content_' . active_locale()})) !!}
    </article>

    <div class="mt-12 pt-6 border-t border-gray-200">
        <a href="{{ route('public.blog', ['locale' => active_locale()]) }}"
           class="inline-flex items-center gap-2 text-sm text-blue-600 font-medium hover:underline">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            {{ active_locale() === 'fr' ? 'Retour au blog' : 'Back to blog' }}
        </a>
    </div>
</div>

@endsection

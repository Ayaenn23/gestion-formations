@extends('layouts.admin')

@php $pageTitle = 'Nouvel article'; @endphp

@section('content')

<div class="max-w-4xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Nouvel article</h2>
            <p class="text-sm text-gray-500">Rédigez un article en français et en anglais</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.posts.store') }}" class="space-y-5">
        @csrf

        {{-- Contenu --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Contenu</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="title_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Titre FR <span class="text-red-500">*</span></label>
                    <input id="title_fr" type="text" name="title_fr" value="{{ old('title_fr') }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="title_en" class="block text-sm font-medium text-gray-700 mb-1.5">Titre EN <span class="text-red-500">*</span></label>
                    <input id="title_en" type="text" name="title_en" value="{{ old('title_en') }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1.5">Catégorie <span class="text-red-500">*</span></label>
                    <select id="category_id" name="category_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                        <option value="">— Choisir —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name_fr }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-1.5">Statut <span class="text-red-500">*</span></label>
                    <select id="statut" name="statut" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                        @foreach(['brouillon','publié','archivé'] as $s)
                            <option value="{{ $s }}" {{ old('statut') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="publication_date" class="block text-sm font-medium text-gray-700 mb-1.5">Date de publication</label>
                    <input id="publication_date" type="date" name="publication_date" value="{{ old('publication_date') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="content_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Contenu FR</label>
                    <textarea id="content_fr" name="content_fr" rows="10"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('content_fr') }}</textarea>
                </div>
                <div>
                    <label for="content_en" class="block text-sm font-medium text-gray-700 mb-1.5">Contenu EN</label>
                    <textarea id="content_en" name="content_en" rows="10"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('content_en') }}</textarea>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">SEO</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="seo_title_fr" class="block text-sm font-medium text-gray-700 mb-1.5">SEO Title FR</label>
                    <input id="seo_title_fr" type="text" name="seo_title_fr" value="{{ old('seo_title_fr') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="seo_title_en" class="block text-sm font-medium text-gray-700 mb-1.5">SEO Title EN</label>
                    <input id="seo_title_en" type="text" name="seo_title_en" value="{{ old('seo_title_en') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="meta_description_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description FR</label>
                    <textarea id="meta_description_fr" name="meta_description_fr" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('meta_description_fr') }}</textarea>
                </div>
                <div>
                    <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description EN</label>
                    <textarea id="meta_description_en" name="meta_description_en" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('meta_description_en') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Publier l'article
            </button>
        </div>
    </form>
</div>

@endsection

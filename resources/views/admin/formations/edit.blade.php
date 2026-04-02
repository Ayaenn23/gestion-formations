@extends('layouts.admin')

@php $pageTitle = 'Modifier la formation'; @endphp

@section('content')

<div class="max-w-4xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.formations.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Modifier la formation</h2>
            <p class="text-sm text-gray-500">{{ $formation->titre_fr }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.formations.update', $formation) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Infos générales --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Informations générales</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="titre_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Titre FR <span class="text-red-500">*</span></label>
                    <input id="titre_fr" type="text" name="titre_fr" value="{{ old('titre_fr', $formation->titre_fr) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="titre_en" class="block text-sm font-medium text-gray-700 mb-1.5">Titre EN <span class="text-red-500">*</span></label>
                    <input id="titre_en" type="text" name="titre_en" value="{{ old('titre_en', $formation->titre_en) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1.5">Catégorie <span class="text-red-500">*</span></label>
                    <select id="category_id" name="category_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (old('category_id', $formation->category_id) == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name_fr }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1.5">Prix (MAD)</label>
                    <input id="prix" type="number" step="0.01" name="prix" value="{{ old('prix', $formation->prix) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="duree" class="block text-sm font-medium text-gray-700 mb-1.5">Durée</label>
                    <input id="duree" type="text" name="duree" value="{{ old('duree', $formation->duree) }}" placeholder="ex: 3 jours"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="niveau" class="block text-sm font-medium text-gray-700 mb-1.5">Niveau</label>
                    <select id="niveau" name="niveau"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                        <option value="">— Choisir —</option>
                        @foreach(['débutant','intermédiaire','avancé'] as $niv)
                            <option value="{{ $niv }}" {{ old('niveau', $formation->niveau) == $niv ? 'selected' : '' }}>{{ ucfirst($niv) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-1.5">Statut <span class="text-red-500">*</span></label>
                    <select id="statut" name="statut" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->value }}" {{ old('statut', $formation->statut?->value) == $statut->value ? 'selected' : '' }}>
                                {{ ucfirst($statut->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_publication" class="block text-sm font-medium text-gray-700 mb-1.5">Date de publication</label>
                    <input id="date_publication" type="date" name="date_publication"
                           value="{{ old('date_publication', $formation->date_publication) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1.5">Image</label>
                @if($formation->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $formation->image) }}" alt="Aperçu actuel"
                             class="h-16 w-24 rounded-lg border border-gray-200 object-cover">
                        <p class="text-xs text-gray-400">Image actuelle — remplacez-la en choisissant un nouveau fichier</p>
                    </div>
                @endif
                <input id="image" type="file" name="image" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
        </div>

        {{-- Descriptions --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Descriptions</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="description_courte_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Description courte FR</label>
                    <textarea id="description_courte_fr" name="description_courte_fr" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('description_courte_fr', $formation->description_courte_fr) }}</textarea>
                </div>
                <div>
                    <label for="description_courte_en" class="block text-sm font-medium text-gray-700 mb-1.5">Description courte EN</label>
                    <textarea id="description_courte_en" name="description_courte_en" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('description_courte_en', $formation->description_courte_en) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="description_complete_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Description complète FR</label>
                    <textarea id="description_complete_fr" name="description_complete_fr" rows="7"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('description_complete_fr', $formation->description_complete_fr) }}</textarea>
                </div>
                <div>
                    <label for="description_complete_en" class="block text-sm font-medium text-gray-700 mb-1.5">Description complète EN</label>
                    <textarea id="description_complete_en" name="description_complete_en" rows="7"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('description_complete_en', $formation->description_complete_en) }}</textarea>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest">SEO</h3>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="seo_title_fr" class="block text-sm font-medium text-gray-700 mb-1.5">SEO Title FR</label>
                    <input id="seo_title_fr" type="text" name="seo_title_fr" value="{{ old('seo_title_fr', $formation->seo_title_fr) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="seo_title_en" class="block text-sm font-medium text-gray-700 mb-1.5">SEO Title EN</label>
                    <input id="seo_title_en" type="text" name="seo_title_en" value="{{ old('seo_title_en', $formation->seo_title_en) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="seo_description_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description FR</label>
                    <textarea id="seo_description_fr" name="seo_description_fr" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('seo_description_fr', $formation->seo_description_fr) }}</textarea>
                </div>
                <div>
                    <label for="seo_description_en" class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description EN</label>
                    <textarea id="seo_description_en" name="seo_description_en" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('seo_description_en', $formation->seo_description_en) }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.formations.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

@endsection

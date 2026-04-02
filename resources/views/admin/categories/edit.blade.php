@extends('layouts.admin')

@php $pageTitle = 'Modifier la catégorie'; @endphp

@section('content')

<div class="max-w-xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Modifier la catégorie</h2>
            <p class="text-sm text-gray-500">{{ $category->name_fr }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Nom FR <span class="text-red-500">*</span></label>
            <input id="name_fr" type="text" name="name_fr" value="{{ old('name_fr', $category->name_fr) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <div>
            <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1.5">Nom EN <span class="text-red-500">*</span></label>
            <input id="name_en" type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

@endsection

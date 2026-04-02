@extends('layouts.admin')

@php $pageTitle = 'Modifier l\'utilisateur'; @endphp

@section('content')

<div class="max-w-xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Modifier l'utilisateur</h2>
            <p class="text-sm text-gray-500">{{ $user->name }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom complet <span class="text-red-500">*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Téléphone</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                Nouveau mot de passe
                <span class="text-gray-400 font-normal">(laisser vide pour ne pas changer)</span>
            </label>
            <input id="password" type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1.5">Rôle <span class="text-red-500">*</span></label>
                <select id="role" name="role"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="language" class="block text-sm font-medium text-gray-700 mb-1.5">Langue</label>
                <select id="language" name="language"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                    <option value="fr" {{ old('language', $user->language) == 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="en" {{ old('language', $user->language) == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">Compte actif</label>
        </div>

        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

@endsection

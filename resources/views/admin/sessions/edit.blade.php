@extends('layouts.admin')

@php $pageTitle = 'Modifier la session'; @endphp

@section('content')

<div class="max-w-2xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.sessions.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Modifier la session</h2>
            <p class="text-sm text-gray-500">{{ $session->formation?->titre_fr ?? '' }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.sessions.update', $session) }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="formation_id" class="block text-sm font-medium text-gray-700 mb-1.5">Formation <span class="text-red-500">*</span></label>
            <select id="formation_id" name="formation_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                @foreach($formations as $f)
                    <option value="{{ $f->id }}" {{ (old('formation_id', $session->formation_id) == $f->id) ? 'selected' : '' }}>
                        {{ $f->titre_fr }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="trainer_id" class="block text-sm font-medium text-gray-700 mb-1.5">Formateur <span class="text-red-500">*</span></label>
            <select id="trainer_id" name="trainer_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                @foreach($trainers as $t)
                    <option value="{{ $t->id }}" {{ (old('trainer_id', $session->trainer_id) == $t->id) ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">Date de début <span class="text-red-500">*</span></label>
                <input id="start_date" type="datetime-local" name="start_date" required
                       value="{{ old('start_date', \Carbon\Carbon::parse($session->start_date)->format('Y-m-d\TH:i')) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1.5">Date de fin <span class="text-red-500">*</span></label>
                <input id="end_date" type="datetime-local" name="end_date" required
                       value="{{ old('end_date', \Carbon\Carbon::parse($session->end_date)->format('Y-m-d\TH:i')) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1.5">Capacité</label>
                <input id="capacity" type="number" name="capacity" value="{{ old('capacity', $session->capacity) }}" min="1"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div>
                <label for="mode" class="block text-sm font-medium text-gray-700 mb-1.5">Mode <span class="text-red-500">*</span></label>
                <select id="mode" name="mode" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                    @foreach($modes as $mode)
                        <option value="{{ $mode->value }}" {{ old('mode', $session->mode?->value) == $mode->value ? 'selected' : '' }}>
                            {{ ucfirst($mode->value) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="statut" class="block text-sm font-medium text-gray-700 mb-1.5">Statut <span class="text-red-500">*</span></label>
                <select id="statut" name="statut" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                    @foreach(['planifiée','en cours','terminée','annulée'] as $s)
                        <option value="{{ $s }}" {{ old('statut', $session->statut) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="ville" class="block text-sm font-medium text-gray-700 mb-1.5">Ville</label>
                <input id="ville" type="text" name="ville" value="{{ old('ville', $session->ville) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <div>
                <label for="lien_reunion" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Lien de réunion <span class="text-gray-400 font-normal">(si en ligne)</span>
                </label>
                <input id="lien_reunion" type="url" name="lien_reunion" value="{{ old('lien_reunion', $session->lien_reunion) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
        </div>

        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
            <a href="{{ route('admin.sessions.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

@endsection

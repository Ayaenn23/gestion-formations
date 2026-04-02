@extends('layouts.admin')

@php $pageTitle = 'Modifier l\'inscription'; @endphp

@section('content')

<div class="max-w-xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.enrollments.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Modifier l'inscription</h2>
            <p class="text-sm text-gray-500">Réf. {{ $enrollment->enrollment_ref }}</p>
        </div>
    </div>

    {{-- Infos en lecture seule --}}
    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-5 grid grid-cols-2 gap-4">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Participant</p>
            <p class="text-sm font-semibold text-gray-800">{{ $enrollment->user?->name ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Formation</p>
            <p class="text-sm font-semibold text-gray-800">{{ $enrollment->trainingSession?->formation?->titre_fr ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Session</p>
            <p class="text-sm text-gray-700">
                {{ $enrollment->trainingSession ? \Carbon\Carbon::parse($enrollment->trainingSession->start_date)->format('d/m/Y') : '—' }}
            </p>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Référence</p>
            <code class="text-xs bg-white border border-gray-200 text-gray-600 px-2 py-0.5 rounded font-mono">{{ $enrollment->enrollment_ref }}</code>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="statut" class="block text-sm font-medium text-gray-700 mb-1.5">Statut <span class="text-red-500">*</span></label>
            <select id="statut" name="statut" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                @foreach($statuts as $statut)
                    <option value="{{ $statut->value }}" {{ $enrollment->statut?->value == $statut->value ? 'selected' : '' }}>
                        {{ ucfirst($statut->value) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="note" class="block text-sm font-medium text-gray-700 mb-1.5">Note interne</label>
            <textarea id="note" name="note" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('note', $enrollment->note) }}</textarea>
        </div>

        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
            <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

@endsection

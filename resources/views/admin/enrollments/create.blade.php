@extends('layouts.admin')

@php $pageTitle = 'Nouvelle inscription'; @endphp

@section('content')

<div class="max-w-xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.enrollments.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h2 class="text-lg font-bold text-gray-900">Nouvelle inscription</h2>
            <p class="text-sm text-gray-500">Inscrire un participant à une session</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.enrollments.store') }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf

        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1.5">Participant <span class="text-red-500">*</span></label>
            <select id="user_id" name="user_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                <option value="">— Choisir un participant —</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} — {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="training_session_id" class="block text-sm font-medium text-gray-700 mb-1.5">Session <span class="text-red-500">*</span></label>
            <select id="training_session_id" name="training_session_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">
                <option value="">— Choisir une session —</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}" {{ old('training_session_id') == $session->id ? 'selected' : '' }}>
                        {{ $session->formation?->titre_fr ?? '?' }} — {{ \Carbon\Carbon::parse($session->start_date)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="note" class="block text-sm font-medium text-gray-700 mb-1.5">Note interne</label>
            <textarea id="note" name="note" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">{{ old('note') }}</textarea>
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

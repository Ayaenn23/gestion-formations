@extends('layouts.admin')

@php $pageTitle = 'Utilisateurs'; @endphp

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-lg font-bold text-gray-900">Utilisateurs</h2>
        <p class="text-sm text-gray-500 mt-0.5">Gérez les comptes utilisateurs</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        Ajouter
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Téléphone</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rôle</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Langue</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 text-xs font-bold flex items-center justify-center flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-3.5 text-gray-500">{{ $user->email }}</td>
                <td class="px-5 py-3.5 text-gray-500">{{ $user->phone ?? '—' }}</td>
                <td class="px-5 py-3.5">
                    @foreach($user->getRoleNames() as $role)
                        <span class="inline-block text-xs px-2 py-0.5 rounded-full font-semibold bg-indigo-50 text-indigo-700">{{ $role }}</span>
                    @endforeach
                </td>
                <td class="px-5 py-3.5">
                    <span class="inline-block text-xs px-2 py-0.5 rounded-full font-semibold bg-gray-100 text-gray-600 uppercase">{{ $user->language }}</span>
                </td>
                <td class="px-5 py-3.5">
                    @if($user->is_active)
                        <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-full font-semibold bg-green-50 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Actif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-full font-semibold bg-red-50 text-red-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Inactif
                        </span>
                    @endif
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline">Modifier</a>
                        <span class="text-gray-200">|</span>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cet utilisateur ?')"
                                    class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                    <p class="text-sm">Aucun utilisateur enregistré.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

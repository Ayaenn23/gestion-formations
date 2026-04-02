@extends('layouts.admin')
@section('content')
    <h1>Modifier l'utilisateur</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf @method('PUT')
        <div><label>Nom</label><input type="text" name="name" value="{{ old('name', $user->name) }}"></div>
        <div><label>Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}"></div>
        <div><label>Téléphone</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}"></div>
        <div><label>Nouveau mot de passe (optionnel)</label><input type="password" name="password"></div>
        <div>
            <label>Rôle</label>
            <select name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Langue</label>
            <select name="language">
                <option value="fr" {{ $user->language == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="en" {{ $user->language == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </div>
        <div><label>Actif</label><input type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }}></div>
        <button type="submit">Modifier</button>
    </form>
@endsection

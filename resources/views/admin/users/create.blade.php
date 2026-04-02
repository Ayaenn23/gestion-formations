@extends('layouts.admin')
@section('content')
    <h1>Ajouter un utilisateur</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div><label>Nom</label><input type="text" name="name" value="{{ old('name') }}"></div>
        <div><label>Email</label><input type="email" name="email" value="{{ old('email') }}"></div>
        <div><label>Téléphone</label><input type="text" name="phone" value="{{ old('phone') }}"></div>
        <div><label>Mot de passe</label><input type="password" name="password"></div>
        <div>
            <label>Rôle</label>
            <select name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Langue</label>
            <select name="language">
                <option value="fr">Français</option>
                <option value="en">English</option>
            </select>
        </div>
        <div><label>Actif</label><input type="checkbox" name="is_active" checked></div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection

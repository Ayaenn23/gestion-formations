@extends('layouts.admin')
@section('content')
    <h1>Modifier la session</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.sessions.update', $session) }}">
        @csrf @method('PUT')
        <div>
            <label>Formation</label>
            <select name="formation_id">
                @foreach($formations as $f)
                    <option value="{{ $f->id }}" {{ $session->formation_id == $f->id ? 'selected' : '' }}>{{ $f->titre_fr }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Formateur</label>
            <select name="trainer_id">
                @foreach($trainers as $t)
                    <option value="{{ $t->id }}" {{ $session->trainer_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Date début</label><input type="datetime-local" name="start_date" value="{{ $session->start_date }}"></div>
        <div><label>Date fin</label><input type="datetime-local" name="end_date" value="{{ $session->end_date }}"></div>
        <div><label>Capacité</label><input type="number" name="capacity" value="{{ $session->capacity }}"></div>
        <div>
            <label>Mode</label>
            <select name="mode">
                @foreach($modes as $mode)
                    <option value="{{ $mode->value }}" {{ $session->mode->value == $mode->value ? 'selected' : '' }}>{{ $mode->value }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Ville</label><input type="text" name="ville" value="{{ $session->ville }}"></div>
        <div><label>Lien réunion</label><input type="text" name="lien_reunion" value="{{ $session->lien_reunion }}"></div>
        <div>
            <label>Statut</label>
            <select name="statut">
                @foreach(['planifiée','en cours','terminée','annulée'] as $s)
                    <option value="{{ $s }}" {{ $session->statut == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Modifier</button>
    </form>
@endsection

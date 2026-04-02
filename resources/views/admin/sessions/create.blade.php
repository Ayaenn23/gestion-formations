@extends('layouts.admin')
@section('content')
    <h1>Ajouter une session</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.sessions.store') }}">
        @csrf
        <div>
            <label>Formation</label>
            <select name="formation_id">
                @foreach($formations as $f)
                    <option value="{{ $f->id }}">{{ $f->titre_fr }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Formateur</label>
            <select name="trainer_id">
                @foreach($trainers as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Date début</label><input type="datetime-local" name="start_date"></div>
        <div><label>Date fin</label><input type="datetime-local" name="end_date"></div>
        <div><label>Capacité</label><input type="number" name="capacity"></div>
        <div>
            <label>Mode</label>
            <select name="mode">
                @foreach($modes as $mode)
                    <option value="{{ $mode->value }}">{{ $mode->value }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Ville</label><input type="text" name="ville"></div>
        <div><label>Lien réunion</label><input type="text" name="lien_reunion"></div>
        <div>
            <label>Statut</label>
            <select name="statut">
                <option value="planifiée">Planifiée</option>
                <option value="en cours">En cours</option>
                <option value="terminée">Terminée</option>
                <option value="annulée">Annulée</option>
            </select>
        </div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection

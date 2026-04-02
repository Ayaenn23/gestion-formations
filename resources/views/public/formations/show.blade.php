@extends('layouts.public')
@section('content')
    <h1>{{ $formation->{'titre_' . active_locale()} }}</h1>
    <p>{{ $formation->{'description_courte_' . active_locale()} }}</p>
    <div>{{ $formation->{'description_complete_' . active_locale()} }}</div>
    <p>Prix : {{ format_price($formation->prix ?? 0) }}</p>
    <p>Durée : {{ $formation->duree }}</p>
    <p>Niveau : {{ $formation->niveau }}</p>

    <h2>{{ active_locale() == 'fr' ? 'Sessions disponibles' : 'Available Sessions' }}</h2>
    @foreach($formation->trainingSessions as $session)
        <div>
            <p>{{ $session->start_date }} → {{ $session->end_date }}</p>
            <p>{{ $session->mode->value }} | {{ $session->ville }}</p>
        </div>
    @endforeach
@endsection

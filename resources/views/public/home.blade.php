@extends('layouts.public')
@section('content')
    <h1>{{ active_locale() == 'fr' ? 'Bienvenue' : 'Welcome' }}</h1>

    <h2>{{ active_locale() == 'fr' ? 'Formations récentes' : 'Recent Trainings' }}</h2>
    @foreach($formations as $formation)
        <div>
            <h3>{{ $formation->{'titre_' . active_locale()} }}</h3>
            <p>{{ $formation->{'description_courte_' . active_locale()} }}</p>
            <a href="{{ route('public.formations.show', ['locale' => active_locale(), 'slug' => $formation->{'slug_' . active_locale()}]) }}">
                {{ active_locale() == 'fr' ? 'Voir plus' : 'Read more' }}
            </a>
        </div>
    @endforeach
@endsection

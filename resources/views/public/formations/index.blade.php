@extends('layouts.public')
@section('content')
    <h1>{{ active_locale() == 'fr' ? 'Formations' : 'Trainings' }}</h1>

    @foreach($formations as $formation)
        <div>
            <h2>{{ $formation->{'titre_' . active_locale()} }}</h2>
            <p>{{ $formation->{'description_courte_' . active_locale()} }}</p>
            <p>{{ format_price($formation->prix ?? 0) }}</p>
            <a href="{{ route('public.formations.show', ['locale' => active_locale(), 'slug' => $formation->{'slug_' . active_locale()}]) }}">
                {{ active_locale() == 'fr' ? 'Voir plus' : 'Read more' }}
            </a>
        </div>
    @endforeach
@endsection

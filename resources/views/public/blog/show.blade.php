@extends('layouts.public')
@section('content')
    <h1>{{ $post->{'title_' . active_locale()} }}</h1>
    <p>{{ $post->author->name }} | {{ $post->publication_date }}</p>
    <div>{{ $post->{'content_' . active_locale()} }}</div>
@endsection

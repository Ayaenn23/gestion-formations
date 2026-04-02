@extends('layouts.public')
@section('content')
    <h1>Blog</h1>
    @foreach($posts as $post)
        <div>
            <h2>{{ $post->{'title_' . active_locale()} }}</h2>
            <p>{{ $post->author->name }}</p>
            <a href="{{ route('public.blog.show', ['locale' => active_locale(), 'slug' => $post->{'slug_' . active_locale()}]) }}">
                {{ active_locale() == 'fr' ? 'Lire' : 'Read' }}
            </a>
        </div>
    @endforeach
@endsection

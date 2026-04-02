@extends('layouts.admin')
@section('content')
    <h1>Modifier l'article</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @csrf @method('PUT')
        <div><label>Titre FR</label><input type="text" name="title_fr" value="{{ old('title_fr', $post->title_fr) }}"></div>
        <div><label>Titre EN</label><input type="text" name="title_en" value="{{ old('title_en', $post->title_en) }}"></div>
        <div>
            <label>Catégorie</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name_fr }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Contenu FR</label><textarea name="content_fr" rows="5">{{ old('content_fr', $post->content_fr) }}</textarea></div>
        <div><label>Contenu EN</label><textarea name="content_en" rows="5">{{ old('content_en', $post->content_en) }}</textarea></div>
        <div>
            <label>Statut</label>
            <select name="statut">
                @foreach(['brouillon','publié','archivé'] as $s)
                    <option value="{{ $s }}" {{ $post->statut == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Date de publication</label><input type="date" name="publication_date" value="{{ old('publication_date', $post->publication_date) }}"></div>
        <div><label>SEO Title FR</label><input type="text" name="seo_title_fr" value="{{ old('seo_title_fr', $post->seo_title_fr) }}"></div>
        <div><label>SEO Title EN</label><input type="text" name="seo_title_en" value="{{ old('seo_title_en', $post->seo_title_en) }}"></div>
        <div><label>Meta Description FR</label><textarea name="meta_description_fr">{{ old('meta_description_fr', $post->meta_description_fr) }}</textarea></div>
        <div><label>Meta Description EN</label><textarea name="meta_description_en">{{ old('meta_description_en', $post->meta_description_en) }}</textarea></div>
        <button type="submit">Modifier</button>
    </form>
@endsection

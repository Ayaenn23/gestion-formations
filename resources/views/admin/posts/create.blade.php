@extends('layouts.admin')
@section('content')
    <h1>Ajouter un article</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        <div><label>Titre FR</label><input type="text" name="title_fr" value="{{ old('title_fr') }}"></div>
        <div><label>Titre EN</label><input type="text" name="title_en" value="{{ old('title_en') }}"></div>
        <div>
            <label>Catégorie</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name_fr }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Contenu FR</label><textarea name="content_fr" rows="5">{{ old('content_fr') }}</textarea></div>
        <div><label>Contenu EN</label><textarea name="content_en" rows="5">{{ old('content_en') }}</textarea></div>
        <div>
            <label>Statut</label>
            <select name="statut">
                <option value="brouillon">Brouillon</option>
                <option value="publié">Publié</option>
                <option value="archivé">Archivé</option>
            </select>
        </div>
        <div><label>Date de publication</label><input type="date" name="publication_date"></div>
        <div><label>SEO Title FR</label><input type="text" name="seo_title_fr" value="{{ old('seo_title_fr') }}"></div>
        <div><label>SEO Title EN</label><input type="text" name="seo_title_en" value="{{ old('seo_title_en') }}"></div>
        <div><label>Meta Description FR</label><textarea name="meta_description_fr">{{ old('meta_description_fr') }}</textarea></div>
        <div><label>Meta Description EN</label><textarea name="meta_description_en">{{ old('meta_description_en') }}</textarea></div>
        <button type="submit">Enregistrer</button>
    </form>
@endsection

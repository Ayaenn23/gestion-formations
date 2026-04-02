@extends('layouts.admin')
@section('content')
    <h1>Modifier la formation</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)<p style="color:red">{{ $error }}</p>@endforeach
    @endif

    <form method="POST" action="{{ route('admin.formations.update', $formation) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div><label>Titre FR</label><input type="text" name="titre_fr" value="{{ old('titre_fr', $formation->titre_fr) }}"></div>
        <div><label>Titre EN</label><input type="text" name="titre_en" value="{{ old('titre_en', $formation->titre_en) }}"></div>
        <div>
            <label>Catégorie</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $formation->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name_fr }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Description courte FR</label><textarea name="description_courte_fr">{{ old('description_courte_fr', $formation->description_courte_fr) }}</textarea></div>
        <div><label>Description courte EN</label><textarea name="description_courte_en">{{ old('description_courte_en', $formation->description_courte_en) }}</textarea></div>
        <div><label>Description complète FR</label><textarea name="description_complete_fr">{{ old('description_complete_fr', $formation->description_complete_fr) }}</textarea></div>
        <div><label>Description complète EN</label><textarea name="description_complete_en">{{ old('description_complete_en', $formation->description_complete_en) }}</textarea></div>
        @if($formation->image)
            <div><img src="{{ asset('storage/'.$formation->image) }}" width="100"></div>
        @endif
        <div><label>Nouvelle image</label><input type="file" name="image"></div>
        <div><label>Prix</label><input type="number" step="0.01" name="prix" value="{{ old('prix', $formation->prix) }}"></div>
        <div><label>Durée</label><input type="text" name="duree" value="{{ old('duree', $formation->duree) }}"></div>
        <div><label>Niveau</label><input type="text" name="niveau" value="{{ old('niveau', $formation->niveau) }}"></div>
        <div>
            <label>Statut</label>
            <select name="statut">
                @foreach($statuts as $statut)
                    <option value="{{ $statut->value }}" {{ $formation->statut->value == $statut->value ? 'selected' : '' }}>{{ $statut->value }}</option>
                @endforeach
            </select>
        </div>
        <div><label>Date de publication</label><input type="date" name="date_publication" value="{{ old('date_publication', $formation->date_publication) }}"></div>
        <div><label>SEO Title FR</label><input type="text" name="seo_title_fr" value="{{ old('seo_title_fr', $formation->seo_title_fr) }}"></div>
        <div><label>SEO Title EN</label><input type="text" name="seo_title_en" value="{{ old('seo_title_en', $formation->seo_title_en) }}"></div>
        <div><label>Meta Description FR</label><textarea name="seo_description_fr">{{ old('seo_description_fr', $formation->seo_description_fr) }}</textarea></div>
        <div><label>Meta Description EN</label><textarea name="seo_description_en">{{ old('seo_description_en', $formation->seo_description_en) }}</textarea></div>
        <button type="submit">Modifier</button>
    </form>
@endsection

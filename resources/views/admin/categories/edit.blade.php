@extends('layouts.admin')

@section('content')
    <h1>Modifier une catégorie</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Nom FR</label>
            <input type="text" name="name_fr" value="{{ old('name_fr', $category->name_fr) }}">
        </div>
        <div>
            <label>Nom EN</label>
            <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}">
        </div>
        <button type="submit">Modifier</button>
    </form>
@endsection

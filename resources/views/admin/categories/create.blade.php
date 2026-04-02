@extends('layouts.admin')

@section('content')

<div class="max-w-xl">

    <h2 class="text-lg font-medium text-gray-800 mb-4">
        Ajouter une catégorie
    </h2>

    <form method="POST" action="{{ route('admin.categories.store') }}"
          class="bg-white border border-gray-200 rounded-lg p-5 space-y-4">

        @csrf

        <div>
            <label class="block text-sm text-gray-600 mb-1">Nom FR</label>
            <input type="text" name="name_fr"
                   value="{{ old('name_fr') }}"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Nom EN</label>
            <input type="text" name="name_en"
                   value="{{ old('name_en') }}"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Enregistrer
            </button>
        </div>

    </form>

</div>

@endsection

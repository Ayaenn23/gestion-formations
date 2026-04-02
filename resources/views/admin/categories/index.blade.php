@extends('layouts.admin')
@section('content')

<div class="flex justify-between items-center mb-5">
    <h2 class="text-lg font-medium text-gray-800">Catégories</h2>

    <a href="{{ route('admin.categories.create') }}"
       class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700">
        + Ajouter
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-gray-500 text-xs">Nom FR</th>
                <th class="px-4 py-2 text-left text-gray-500 text-xs">Nom EN</th>
                <th class="px-4 py-2 text-left text-gray-500 text-xs">Slug FR</th>
                <th class="px-4 py-2 text-left text-gray-500 text-xs">Slug EN</th>
                <th class="px-4 py-2 text-left text-gray-500 text-xs">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @foreach($categories as $category)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $category->name_fr }}</td>
                <td class="px-4 py-2">{{ $category->name_en }}</td>
                <td class="px-4 py-2 text-gray-500">{{ $category->slug_fr }}</td>
                <td class="px-4 py-2 text-gray-500">{{ $category->slug_en }}</td>
                <td class="px-4 py-2 flex gap-2">

                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="text-blue-600 hover:underline text-xs">
                        Modifier
                    </a>

                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline text-xs">
                            Supprimer
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection


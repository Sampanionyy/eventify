@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Liste des Catégories</h1>
        
        <a href="{{ route('categories.create') }}" class="bg-cyan-600 text-white px-4 py-2 rounded mt-4">Créer une Catégorie</a>

        <table class="min-w-full mt-6 bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Nom</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="text-cyan-600">Voir</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-cyan-600 ml-4">Modifier</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-4">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection

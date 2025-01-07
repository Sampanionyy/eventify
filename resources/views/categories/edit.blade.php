@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Modifier la Catégorie</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom de la Catégorie</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div>
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
@endsection

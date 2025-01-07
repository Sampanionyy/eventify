@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Créer une Catégorie</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom de la Catégorie</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div>
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Créer</button>
        </form>
    </div>
@endsection

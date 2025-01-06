@extends('layouts.app')

@section('title', 'Créer un événement')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800">Créer un nouvel événement</h1>

    <div class="mt-6">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date et Heure</label>
                <input type="datetime-local" id="date" name="date" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700">Lieu</label>
                <input type="text" id="location" name="location" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Catégorie</label>
                <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded-lg" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded-lg">Créer</button>
        </form>
    </div>
@endsection

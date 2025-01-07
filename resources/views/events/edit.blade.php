@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Modifier l'Événement</h1>
        
        <form action="{{ route('events.update', $event->id) }}" method="POST" class="mt-6">
            @method('PUT')
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre</label>
                <input type="text" name="title" id="title" value="{{ $event->title }}" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" rows="5" required>{{ $event->description }}</textarea>
            </div>
            {{-- <div class="mb-4">
                <label for="date" class="block text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ $event->date->format('Y-m-d') }}" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div> --}}
            <div class="mb-4">
                <label for="location" class="block text-gray-700">Lieu</label>
                <input type="text" name="location" id="location" value="{{ $event->location }}" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Catégorie</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $event->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
@endsection

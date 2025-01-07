@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Détails de l'Événement</h1>

        <div class="mt-6 bg-white p-6 shadow-md rounded-lg">
            <p><strong>Titre :</strong> {{ $event->title }}</p>
            <p><strong>Description :</strong> {{ $event->description }}</p>
            {{-- <p><strong>Date :</strong> {{ $event->date->format('d/m/Y') }}</p> --}}
            <p><strong>Lieu :</strong> {{ $event->location }}</p>
            <p><strong>Catégorie :</strong> {{ $event->category->name }}</p>
            <div class="mt-4">
                <a href="{{ route('events.index') }}" class="bg-cyan-600 text-white px-4 py-2 rounded">Retour à la liste</a>
                <a href="{{ route('events.edit', $event->id) }}" class="bg-cyan-600 text-white px-4 py-2 rounded ml-4">Modifier</a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Liste des Événements</h1>
        
        <a href="{{ route('events.create') }}" class="bg-cyan-600 text-white px-4 py-2 rounded mt-4">Créer un nouvel Événement</a>

        <table class="min-w-full mt-6 bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Catégorie</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td class="border px-4 py-2">{{ $event->title }}</td>
                        <td class="border px-4 py-2">{{ $event->category->name }}</td>
                        <td class="border px-4 py-2">{{ $event->date->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('events.show', $event->id) }}" class="text-cyan-600">Voir</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="text-cyan-600 ml-4">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $events->links() }}
    </div>
@endsection

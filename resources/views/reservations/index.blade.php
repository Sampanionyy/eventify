@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Liste des Réservations</h1>
        
        <a href="{{ route('reservations.create') }}" class="bg-cyan-600 text-white px-4 py-2 rounded mt-4">Créer une Réservation</a>

        <table class="min-w-full mt-6 bg-white shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Nom de l'utilisateur</th>
                    <th class="px-4 py-2 text-left">Événement</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td class="border px-4 py-2">{{ $reservation->user_name }}</td>
                        <td class="border px-4 py-2">{{ $reservation->event->title }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="text-cyan-600">Voir</a>
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-cyan-600 ml-4">Modifier</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-4">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reservations->links() }}
    </div>
@endsection

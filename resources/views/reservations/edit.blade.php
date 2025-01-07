@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold text-gray-900">Modifier la Réservation</h1>

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="user_name" class="block text-gray-700">Nom de l'utilisateur</label>
                <input type="text" name="user_name" id="user_name" value="{{ $reservation->user_name }}" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="event_id" class="block text-gray-700">Événement</label>
                <select name="event_id" id="event_id" class="w-full border-gray-300 focus:border-cyan-600 focus:ring focus:ring-cyan-200 rounded-lg" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $reservation->event_id == $event->id ? 'selected' : '' }}>
                            {{ $event->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
@endsection

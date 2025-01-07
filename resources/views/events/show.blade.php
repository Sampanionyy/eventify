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
                @if(auth()->user()->role === 'ADMIN')
                    <a href="{{ route('events.index') }}" class="bg-cyan-600 text-white px-4 py-2 rounded">Retour à la liste</a>
                    <a href="{{ route('events.edit', $event->id) }}" class="bg-cyan-600 text-white px-4 py-2 rounded ml-1">Modifier</a>
                @elseif(auth()->user()->role === 'CLIENT')
                    <a href="{{ route('events.list') }}" class="bg-cyan-600 text-white px-4 py-2 rounded">Retour à la liste</a>
                    <div class="mt-4 relative">
                        <button 
                            class="bg-cyan-600 text-white px-4 py-2 rounded ml-1 hover:bg-cyan-700" 
                            onclick="toggleReservationInput(this)"
                        >
                            Réserver
                        </button>
                        
                        <!-- Conteneur pour le champ input et le bouton de confirmation -->
                        <div class="hidden mt-2 bg-gray-100 p-3 rounded shadow-md absolute top-12 left-0 z-10">
                            <form action="{{ route('events.reserve', $event->id) }}" method="POST">
                                @csrf
                                <label for="quantity" class="block text-sm text-gray-700 font-medium">Nombre de places :</label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    id="quantity" 
                                    min="1" 
                                    max="{{ $event->available_seats }}" 
                                    class="w-24 mt-1 p-1 border border-gray-300 rounded focus:ring-cyan-500 focus:border-cyan-500"
                                    required
                                >
                    
                                <div class="mt-2 flex space-x-2">
                                    <button 
                                        type="submit" 
                                        class="bg-cyan-600 text-white px-4 py-1 rounded hover:bg-cyan-700"
                                    >
                                        Confirmer
                                    </button>
                                    <button 
                                        type="button" 
                                        class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600" 
                                        onclick="toggleReservationInput(this.closest('div'))"
                                    >
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>                    
                @endif
            </div>
        </div>
    </div>
    <script>
        const toggleReservationInput = (button) => {
            const container = button.nextElementSibling; 
            container.classList.toggle('hidden'); 
        }
        
    </script>
@endsection

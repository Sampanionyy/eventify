@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-900 mt-6 mb-4">Découvrez nos Événements</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img 
                        src="{{ $event->image_url ?? asset('images/default-event.jpg') }}" 
                        alt="Image de l'événement" 
                        class="w-full h-48 object-cover"
                    >
                    <div class="p-4">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $event->title }}</h2>
                        <p class="text-gray-600 mt-2">
                            Catégorie : <span class="font-medium">{{ $event->category->name }}</span>
                        </p>
                        <p class="text-gray-500 mt-2">
                            Date : <span class="font-medium">{{ $event->date }}</span>
                        </p>
                        <p class="text-gray-600 mt-2">
                            Places disponibles : <span class="font-medium">{{ $event->available_seats }}</span>
                        </p>
                        <div class="mt-4">
                            <a 
                                href="{{ route('events.details', $event->id) }}" 
                                class="block text-center bg-cyan-600 text-white py-2 rounded-md hover:bg-cyan-700"
                            >
                                Voir les détails
                            </a>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $events->links('pagination::tailwind') }}
        </div>
    </div>
@endsection

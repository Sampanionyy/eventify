@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mes Réservations</h1>

        @foreach($reservations as $reservation)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->event->title }}</h5>
                    <p class="card-text">{{ $reservation->event->description }}</p>
                    <p class="card-text"><strong>Date : </strong>{{ $reservation->event->date }}</p>
                    <p class="card-text"><strong>Lieu : </strong>{{ $reservation->event->location }}</p>
                    <p class="card-text"><strong>Status : </strong>{{ $reservation->status }}</p>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('cancel-form-{{ $reservation->id }}').submit();">Annuler</a>

                    <form id="cancel-form-{{ $reservation->id }}" action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @endforeach

        {{ $reservations->links() }}
    </div>
@endsection

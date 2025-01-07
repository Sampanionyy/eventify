<?php
    namespace App\Http\Controllers\Api;

    use App\Models\Reservation;
    use App\Models\Event;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
use App\Models\User;

    class ReservationController extends Controller
    {
        public function index()
        {
            $reservations = Reservation::with('event')->paginate(10);
            return view('reservations.index', compact('reservations'));
        }

        public function create()
        {
            $events = Event::all(); // Charger les événements pour les options
            return view('reservations.create', compact('events'));
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'user_name' => 'required|string|max:255',
                'event_id' => 'required|exists:events,id',
            ]);

            Reservation::create($validated);

            return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
        }

        public function show($id)
        {
            $reservation = Reservation::with('event')->findOrFail($id);
            return view('reservations.show', compact('reservation'));
        }

        public function edit($id)
        {
            $reservation = Reservation::findOrFail($id);
            $events = Event::all(); // Charger les événements pour modification
            return view('reservations.edit', compact('reservation', 'events'));
        }

        public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'user_name' => 'required|string|max:255',
                'event_id' => 'required|exists:events,id',
            ]);

            $reservation = Reservation::findOrFail($id);
            $reservation->update($validated);

            return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
        }

        public function destroy($id)
        {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
        }

        public function delete($id)
        {
            $reservation = Reservation::findOrFail($id);

            // Vérifiez si la réservation appartient au client connecté
            if (auth()->user()->role !== 'ADMIN' && $reservation->user_id !== auth()->id()) {
                abort(403, 'Action non autorisée.');
            }

            $reservation->delete();

            return redirect()->route('reservations.my')->with('success', 'Réservation supprimée.');
        }


        public function myReservations()
        {
            $reservations = auth()->user()->reservations()->with('event')->get();
            return view('reservations.my', compact('reservations'));
        }
    }

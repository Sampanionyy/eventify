<?php
    namespace App\Http\Controllers\Api;

    use App\Models\Reservation;
    use App\Models\Event;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class ReservationController extends Controller
    {
        public function index()
        {
            return Reservation::with('user', 'event')->get();
        }

        public function store(Request $request)
        {
            $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'event_id' => 'required|integer|exists:events,id',
            ]);

            return Reservation::create($request->all());
        }

        public function destroy(Reservation $reservation)
        {
            $reservation->delete();
            return response()->noContent();
        }
    }

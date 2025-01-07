<?php
namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Afficher la liste des événements
    public function index()
    {
        $events = Event::with('category')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function listEvents() {
        $events = Event::with('category')->paginate(10);
        return view('events.list', compact('events'));
    }

    // Afficher le formulaire pour créer un nouvel événement
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    // Stocker un nouvel événement
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    // Afficher un événement spécifique
    public function show($id)
    {
        $event = Event::with('category')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Afficher le formulaire pour éditer un événement
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    // Mettre à jour un événement
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $event = Event::find($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    // Supprimer un événement
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès.');
    }

    public function reserve(Request $request, Event $event)
    {
        // Vérifiez si des places sont disponibles
        if ($event->available_seats <= 0) {
            return redirect()->back()->with('error', 'Aucune place disponible pour cet événement.');
        }

        // Créez une réservation
        $reservation = $event->reservations()->create([
            'user_id' => auth()->id(),
        ]);

        // Réduisez le nombre de places disponibles
        $event->decrement('available_seats');

        return redirect()->route('events.details', $event->id)
            ->with('success', 'Votre réservation a été effectuée avec succès.');
    }
}


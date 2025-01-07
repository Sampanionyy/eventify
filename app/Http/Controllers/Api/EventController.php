<?php
namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'total' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        Event::create([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'total' => $validated['total'],
            'category_id' => $validated['category_id'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    public function show($id)
    {
        $event = Event::with('category')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $event = Event::find($id);

        if ($request->hasFile('image')) {
            if ($event->image_url) {
                Storage::delete($event->image_url);
            }
    
            $imagePath = $request->file('image')->store('public/images');
        } else {
            $imagePath = $event->image_url;
        }

        $event->update([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'total' => $validated['total'],
            'category_id' => $validated['category_id'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès.');
    }

    public function reserve(Request $request, Event $event)
    {
        $existingReservation = $event->reservations()->where('user_id', auth()->id())->first();

        if ($existingReservation) {
            return redirect()->back()->with('error', 'Vous avez déjà réservé pour cet événement.');
        }

        if ($event->available_seats <= 0) {
            return redirect()->back()->with('error', 'Aucune place disponible pour cet événement.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $event->available_seats,
        ]);

        $event->reservations()->create([
            'user_id' => auth()->id(),
            'total' => $request->quantity
        ]);

        $event->decrement('available_seats', $request->quantity);

        return redirect()->route('events.details', $event->id)
            ->with('success', 'Votre réservation a été effectuée avec succès.');
    }
}


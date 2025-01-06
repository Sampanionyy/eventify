<?php
namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('category')->get();
    }

    public function show(Event $event)
    {
        return $event->load('category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        return Event::create($request->all());
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $event->update($request->all());

        return $event;
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }
}


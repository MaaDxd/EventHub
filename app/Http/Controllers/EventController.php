<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:150',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['creator_id'] = Auth::id();
        $data['status'] = 'published'; // Marcar como publicado por defecto

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $data['image'] = $imagePath;
        }

        Event::create($data);

        return redirect()->route('dashboard.creator')->with('success', 'Evento creado exitosamente!');
    }

    public function index()
    {
        $events = Event::with(['category', 'creator'])->where('creator_id', Auth::id())->latest()->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // Load relationships
        $event->load(['category', 'creator']);

        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        // Check if user owns this event
        if ($event->creator_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        // Check if user owns this event
        if ($event->creator_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:150',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
            $data['image'] = $imagePath;
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Evento actualizado exitosamente!');
    }

    public function destroy(Event $event)
    {
        // Check if user owns this event
        if ($event->creator_id !== Auth::id()) {
            abort(403);
        }

        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado exitosamente!');
    }
}

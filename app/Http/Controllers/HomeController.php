<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener eventos para el slider (los primeros 5 eventos más recientes publicados)
        $sliderEvents = Event::with(['category', 'creator'])
            ->where('date', '>=', now())
            ->where('status', 'published')
            ->orderBy('date', 'asc')
            ->take(5)
            ->get()
            ->map(function ($event) {
                return [
                    'image' => $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                    'title' => $event->title,
                    'date' => $event->date->format('d \d\e F, Y'),
                    'location' => $event->location
                ];
            });

        // Si no hay eventos reales, usar eventos de ejemplo para el slider
        if ($sliderEvents->isEmpty()) {
            $sliderEvents = collect([
                [
                    'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                    'title' => 'Concierto de Rock',
                    'date' => '25 de Agosto, 2024',
                    'location' => 'Estadio Nacional'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80',
                    'title' => 'Festival de Jazz',
                    'date' => '12 de Septiembre, 2024',
                    'location' => 'Parque Central'
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1515168833906-d2a3b82b3029?auto=format&fit=crop&w=800&q=80',
                    'title' => 'Obra de Teatro',
                    'date' => '05 de Octubre, 2024',
                    'location' => 'Teatro Municipal'
                ],
            ]);
        }

        // Obtener eventos para la sección principal (máximo 12 eventos publicados)
        $featuredEvents = Event::with(['category', 'creator'])
            ->where('date', '>=', now())
            ->where('status', 'published')
            ->orderBy('date', 'asc')
            ->take(12)
            ->get();

        return view('welcome', [
            'events' => $sliderEvents,
            'featuredEvents' => $featuredEvents
        ]);
    }

    public function allEvents(Request $request)
    {
        $query = Event::with(['category', 'creator'])
            ->where('date', '>=', now());

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }

        $events = $query->orderBy('date', 'asc')->paginate(12);
        $categories = Category::all();

        return view('events.all', compact('events', 'categories'));
    }
}

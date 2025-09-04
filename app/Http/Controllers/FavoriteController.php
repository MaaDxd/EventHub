<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Mostrar todos los eventos favoritos del usuario
     */
    public function index()
    {
        $user = Auth::user();
        $favoriteEvents = $user->favoriteEvents()
            ->with(['category', 'creator'])
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->paginate(12);

        return view('favorites.index', compact('favoriteEvents'));
    }

    /**
     * Agregar un evento a favoritos
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Verificar si ya está en favoritos
        if ($user->hasFavorite($event->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Este evento ya está en tus favoritos'
            ]);
        }

        // Agregar a favoritos
        UserFavorite::create([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Evento agregado a favoritos',
            'is_favorite' => true
        ]);
    }

    /**
     * Quitar un evento de favoritos
     */
    public function destroy(Event $event)
    {
        $user = Auth::user();

        // Buscar y eliminar de favoritos
        $favorite = UserFavorite::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'success' => true,
                'message' => 'Evento removido de favoritos',
                'is_favorite' => false
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Este evento no está en tus favoritos'
        ]);
    }

    /**
     * Verificar si un evento está en favoritos (para AJAX)
     */
    public function check(Event $event)
    {
        $user = Auth::user();
        $isFavorite = $user ? $user->hasFavorite($event->id) : false;

        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}

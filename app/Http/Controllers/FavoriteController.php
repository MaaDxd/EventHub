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
        if (!$user) {
            return redirect()->route('login');
        }
        $favoriteEvents = Event::whereHas('favorites', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
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

        // Verificar si el evento está eliminado
        if ($event->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Evento no encontrado'
            ], 404);
        }

        // Verificar si ya está en favoritos
        if (UserFavorite::where('user_id', $user->id)->where('event_id', $event->id)->exists()) {
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
        try {
            $user = Auth::user();

            // Verificar si el evento está eliminado
            if ($event->trashed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evento no encontrado'
                ], 404);
            }

            // Buscar y eliminar de favoritos
            $favorite = UserFavorite::where('user_id', $user->id)
                ->where('event_id', $event->id)
                ->first();

            if ($favorite) {
                $favorite->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Evento removido de favoritos exitosamente',
                    'is_favorite' => false
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Este evento no está en tus favoritos'
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Error al eliminar favorito: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor. Por favor intenta de nuevo.'
            ], 500);
        }
    }

    /**
     * Verificar si un evento está en favoritos (para AJAX)
     */
    public function check(Event $event)
    {
        $user = Auth::user();

        // Verificar si el evento está eliminado
        if ($event->trashed()) {
            return response()->json([
                'is_favorite' => false
            ]);
        }

        $isFavorite = UserFavorite::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}

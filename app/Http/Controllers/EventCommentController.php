<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class EventCommentController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:event_comments,id'
        ]);

        // Si es una respuesta, verificar que sea el creador del evento
        if ($request->parent_id) {
            if ($event->creator_id !== Auth::id()) {
                return response()->json(['error' => 'Solo el creador del evento puede responder a comentarios.'], 403);
            }
        }

        $comment = EventComment::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'is_creator_response' => $request->parent_id && $event->creator_id === Auth::id()
        ]);

        // Cargar las relaciones para la respuesta
        $comment->load(['user', 'replies.user']);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment,
                'message' => $request->parent_id ? 'Respuesta agregada exitosamente!' : 'Comentario agregado exitosamente!'
            ]);
        }

        return redirect()->back()->with('success', $request->parent_id ? 'Respuesta agregada exitosamente!' : 'Comentario agregado exitosamente!');
    }

    public function destroy(EventComment $comment)
    {
        // Solo el autor del comentario o el creador del evento pueden eliminar comentarios
        if ($comment->user_id !== Auth::id() && $comment->event->creator_id !== Auth::id()) {
            return response()->json(['error' => 'No tienes permisos para eliminar este comentario.'], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comentario eliminado exitosamente!'
        ]);
    }
}

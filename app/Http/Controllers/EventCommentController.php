<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class EventCommentController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Event $event)
    {
        try {
            $request->validate([
                'content' => 'required|string|max:500',
                'parent_id' => 'nullable|exists:event_comments,id'
            ]);

            // Si es una respuesta, verificar que sea el creador del evento
            if ($request->parent_id) {
                if ($event->creator_id !== Auth::id()) {
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(['error' => 'Solo el creador del evento puede responder a comentarios.'], 403);
                    }
                    return redirect()->back()->with('error', 'Solo el creador del evento puede responder a comentarios.');
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

            $message = $request->parent_id ? 'Respuesta agregada exitosamente!' : 'Comentario agregado exitosamente!';
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'comment' => $comment,
                    'message' => $message
                ]);
            }
            
            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Error de validación',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error al crear comentario: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Error interno del servidor. Por favor intenta de nuevo.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Error al crear el comentario. Por favor intenta de nuevo.');
        }
    }

    public function destroy(EventComment $comment)
    {
        // Cargar la relación del evento si no está cargada
        if (!$comment->relationLoaded('event')) {
            $comment->load('event');
        }

        // Verificar que el evento existe y no está eliminado
        if (!$comment->event) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['error' => 'El comentario no pertenece a un evento válido.'], 404);
            }
            return redirect()->back()->with('error', 'El comentario no pertenece a un evento válido.');
        }

        // Solo el autor del comentario o el creador del evento pueden eliminar comentarios
        if ($comment->user_id !== Auth::id() && $comment->event->creator_id !== Auth::id()) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['error' => 'No tienes permisos para eliminar este comentario.'], 403);
            }
            return redirect()->back()->with('error', 'No tienes permisos para eliminar este comentario.');
        }

        try {
            $comment->delete();
            $message = 'Comentario eliminado exitosamente!';
            
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }
            
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error al eliminar comentario: ' . $e->getMessage());
            
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['error' => 'Error al eliminar el comentario. Inténtalo de nuevo.'], 500);
            }
            
            return redirect()->back()->with('error', 'Error al eliminar el comentario. Inténtalo de nuevo.');
        }
    }
}

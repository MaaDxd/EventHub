<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeUsers = User::whereNull('deleted_at')->count();
        $deletedUsers = User::onlyTrashed()->count();

        $totalEvents = Event::count();
        $activeEvents = Event::whereNull('deleted_at')->count();
        $deletedEvents = Event::onlyTrashed()->count();

        return view('dashboard_admin', compact(
            'totalUsers', 'activeUsers', 'deletedUsers',
            'totalEvents', 'activeEvents', 'deletedEvents'
        ));
    }

    /**
     * Display users management page
     */
    public function users(Request $request)
    {
        $query = User::with('createdEvents');

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'deleted') {
                $query = $query->onlyTrashed();
            } elseif ($request->status === 'active') {
                $query->whereNull('deleted_at');
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Display events management page
     */
    public function events(Request $request)
    {
        $query = Event::with(['creator', 'category']);

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'deleted') {
                $query->onlyTrashed();
            } elseif ($request->status === 'active') {
                $query->whereNull('deleted_at');
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        $events = $query->paginate(15);

        return view('admin.events', compact('events'));
    }

    /**
     * Soft delete a user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Restore a soft deleted user
     */
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', 'Usuario restaurado correctamente.');
    }

    /**
     * Permanently delete a user
     */
    public function forceDeleteUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Prevent admin from force deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes eliminar permanentemente tu propia cuenta.');
        }

        $user->forceDelete();

        return redirect()->back()->with('success', 'Usuario eliminado permanentemente.');
    }

    /**
     * Soft delete an event
     */
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Evento eliminado correctamente.');
    }

    /**
     * Restore a soft deleted event
     */
    public function restoreEvent($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();

        return redirect()->back()->with('success', 'Evento restaurado correctamente.');
    }

    /**
     * Permanently delete an event
     */
    public function forceDeleteEvent($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->forceDelete();

        return redirect()->back()->with('success', 'Evento eliminado permanentemente.');
    }
}

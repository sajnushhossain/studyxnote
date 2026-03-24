<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of notes.
     */
    public function index(Request $request)
    {
        $query = Note::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $notes = $query->latest()->paginate(12)->withQueryString();
        $categories = \App\Models\Category::has('notes')->get();

        return view('notes.index', compact('notes', 'categories'));
    }

    /**
     * Display the specified note and track views.
     */
    public function show(Note $note)
    {
        // Increment global view count
        $note->increment('view_count');

        // Track user-specific view if authenticated
        if (Auth::check()) {
            Auth::user()->viewedNotes()->syncWithoutDetaching([
                $note->id => ['viewed_at' => now()]
            ]);
        }

        return view('notes.show', compact('note'));
    }
}

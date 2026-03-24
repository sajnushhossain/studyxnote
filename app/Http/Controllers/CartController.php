<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add a note to the cart.
     */
    public function store(Note $note)
    {
        Auth::user()->cartNotes()->syncWithoutDetaching([$note->id]);

        return back()->with('status', 'Note added to your cart!');
    }

    /**
     * Remove a note from the cart.
     */
    public function destroy(Note $note)
    {
        Auth::user()->cartNotes()->detach($note->id);

        return back()->with('status', 'Note removed from your cart!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_notes' => Note::count(),
            'total_users' => User::count(),
            'total_views' => Note::sum('view_count'),
            'total_categories' => Category::count(),
        ];

        $recent_notes = Note::with('category')->latest()->take(5)->get();
        $top_notes = Note::orderBy('view_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_notes', 'top_notes'));
    }
}

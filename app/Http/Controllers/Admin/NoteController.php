<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('category')->latest()->paginate(10);
        return view('admin.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.notes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required_without:new_category_name|nullable|exists:categories,id',
                'new_category_name' => 'required_without:category_id|nullable|string|max:255',
                'title' => 'required|string|max:255',
                'type' => 'required|in:text,image',
                'content' => 'required_if:type,text|nullable|string',
                'image' => 'required_if:type,image|nullable|image|max:24576', // 24MB
            ]);

            $categoryId = $request->category_id;

            if ($request->filled('new_category_name')) {
                $category = Category::firstOrCreate([
                    'name' => $request->new_category_name,
                ], [
                    'slug' => Str::slug($request->new_category_name),
                    'type' => 'grade',
                ]);
                $categoryId = $category->id;
            }

            $content = $request->content ?? '';

            if ($request->hasFile('image') && $request->type === 'image') {
                $path = $request->file('image')->store('notes', 'public');
                $content = $path;
            }

            Note::create([
                'category_id' => $categoryId,
                'title' => $request->title,
                'content' => $content,
                'type' => $request->type,
                'view_count' => 0,
            ]);

            return redirect()->route('admin.notes.index')->with('success', 'Note published successfully.');
        } catch (\Exception $e) {
            Log::error('Publishing Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to publish: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $categories = Category::all();
        return view('admin.notes.edit', compact('note', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required_without:new_category_name|nullable|exists:categories,id',
                'new_category_name' => 'required_without:category_id|nullable|string|max:255',
                'title' => 'required|string|max:255',
                'type' => 'required|in:text,image',
                'content' => 'required_if:type,text|nullable|string',
                'image' => 'nullable|image|max:24576',
            ]);

            $categoryId = $request->category_id;

            if ($request->filled('new_category_name')) {
                $category = Category::firstOrCreate([
                    'name' => $request->new_category_name,
                ], [
                    'slug' => Str::slug($request->new_category_name),
                    'type' => 'grade',
                ]);
                $categoryId = $category->id;
            }

            $content = ($request->type === 'text') ? $request->content : $note->content;

            if ($request->hasFile('image') && $request->type === 'image') {
                if ($note->type === 'image') {
                    Storage::disk('public')->delete($note->content);
                }
                $content = $request->file('image')->store('notes', 'public');
            }

            $note->update([
                'category_id' => $categoryId,
                'title' => $request->title,
                'content' => $content,
                'type' => $request->type,
            ]);

            return redirect()->route('admin.notes.index')->with('success', 'Note updated successfully.');
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->type === 'image') {
            Storage::disk('public')->delete($note->content);
        }
        $note->delete();

        return redirect()->route('admin.notes.index')->with('success', 'Note deleted successfully.');
    }
}

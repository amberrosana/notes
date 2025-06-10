<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";

        if ($search != "") {
            $notes = Note::where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%$search%")
                          ->orWhere('body', 'LIKE', "%$search%");
                })
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $notes = Note::where('user_id', Auth::id())
                 ->orderBy('updated_at', 'desc')
                 ->get();
        }

        return view('dashboard', compact('notes', 'search'));
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:10000',
        ]);

        Note::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route(route: 'dashboard')->with('success', 'Note created.');
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:10000',
        ]);

        $note->update($validated);

        return redirect()->route('dashboard')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Note deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // Menampilkan semua catatan milik user
    public function index()
    {
        $notes = Auth::user()->notes()
            ->latest()
            ->get();

        return view('notes.index', compact('notes'));
    }

    // Menampilkan halaman tambah catatan
    public function create()
    {
        return view('notes.create');
    }

    // Menyimpan catatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        Auth::user()->notes()->create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Catatan berhasil ditambahkan!');
    }

    // Memastikan catatan milik user yang sedang login
    private function checkOwnership(Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
    }

    // Menampilkan halaman edit
    public function edit(Note $note)
    {
        $this->checkOwnership($note);

        return view('notes.edit', compact('note'));
    }

    // Memperbarui catatan
    public function update(Request $request, Note $note)
    {
        $this->checkOwnership($note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Catatan berhasil diperbarui!');
    }

    // Menghapus catatan
    public function destroy(Note $note)
    {
        $this->checkOwnership($note);

        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Catatan berhasil dihapus!');
    }
}

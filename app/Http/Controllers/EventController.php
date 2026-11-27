<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Auth::user()->events()
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->get();

        return view('events.index', compact('events'));
    }

    // Menampilkan form tambah event
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ]);

        Auth::user()->events()->create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Event $event)
    {
        $this->checkOwnership($event);

        return view('events.edit', compact('event'));
    }

    // Memperbarui event
    public function update(Request $request, Event $event)
    {
        $this->checkOwnership($event);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    // Menghapus event
    public function destroy(Event $event)
    {
        $this->checkOwnership($event);

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    // Memastikan event milik user yang sedang login
    private function checkOwnership(Event $event)
    {
        abort_unless($event->user_id === Auth::id(), 403);
    }
}

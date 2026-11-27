<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckpointController extends Controller
{
    // Menampilkan daftar checkpoint
    public function index()
    {
        $checkpoints = Auth::user()->checkpoints()
            ->orderByRaw('target_date IS NULL')
            ->orderBy('target_date')
            ->latest()
            ->get();

        return view('checkpoints.index', compact('checkpoints'));
    }

    // Menampilkan halaman tambah checkpoint
    public function create()
    {
        return view('checkpoints.create');
    }

    // Menyimpan checkpoint baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'nullable|date',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        Auth::user()->checkpoints()->create($validated);

        return redirect()->route('checkpoints.index')
            ->with('success', 'Checkpoint berhasil ditambahkan!');
    }

    // Memeriksa kepemilikan checkpoint
    private function checkOwnership(Checkpoint $checkpoint)
    {
        abort_unless($checkpoint->user_id === Auth::id(), 403);
    }

    // Menampilkan halaman edit
    public function edit(Checkpoint $checkpoint)
    {
        $this->checkOwnership($checkpoint);

        return view('checkpoints.edit', compact('checkpoint'));
    }

    // Memperbarui checkpoint
    public function update(Request $request, Checkpoint $checkpoint)
    {
        $this->checkOwnership($checkpoint);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'nullable|date',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $checkpoint->update($validated);

        return redirect()->route('checkpoints.index')
            ->with('success', 'Checkpoint berhasil diperbarui!');
    }

    // Menghapus checkpoint
    public function destroy(Checkpoint $checkpoint)
    {
        $this->checkOwnership($checkpoint);

        $checkpoint->delete();

        return redirect()->route('checkpoints.index')
            ->with('success', 'Checkpoint berhasil dihapus!');
    }
}

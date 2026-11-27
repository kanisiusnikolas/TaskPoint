<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    // Menampilkan daftar tugas dengan Search dan Filter
    public function index(Request $request)
    {
        $user = Auth::user();

        // Menghitung statistik seluruh tugas
        $totalTasks = $user->tasks()->count();

        $pendingTasks = $user->tasks()
            ->where('status', 'Pending')
            ->count();

        $completedTasks = $user->tasks()
            ->where('status', 'Completed')
            ->count();

        // Mengambil daftar tugas milik user
        $query = $user->tasks();

        // Search berdasarkan judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if (in_array($request->status, ['Pending', 'In Progress', 'Completed'])) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas
        if (in_array($request->priority, ['Low', 'Medium', 'High'])) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->latest()->get();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'completedTasks'
        ));
    }

    // Form tambah tugas
    public function create()
    {
        return view('tasks.create');
    }

    // Menyimpan tugas
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'due_date' => 'nullable|date',
        ]);

        Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Form edit tugas
    public function edit(Task $task)
    {
        $this->checkOwnership($task);

        return view('tasks.edit', compact('task'));
    }

    // Memperbarui tugas
    public function update(Request $request, Task $task)
    {
        $this->checkOwnership($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    // Menghapus tugas
    public function destroy(Task $task)
    {
        $this->checkOwnership($task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    // Memastikan tugas milik pengguna
    private function checkOwnership(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);
    }
}

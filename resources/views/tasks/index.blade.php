
@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">My Tasks</h1>
            <p class="text-secondary">Kelola semua tugas dan pekerjaanmu.</p>
        </div>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add New Task
        </a>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistik -->
    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-secondary mb-1">Total Tasks</p>
                    <h3 class="fw-bold">{{ $totalTasks }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-secondary mb-1">Pending</p>
                    <h3 class="fw-bold">{{ $pendingTasks }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-secondary mb-1">Completed</p>
                    <h3 class="fw-bold">{{ $completedTasks }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Search dan Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <h5 class="fw-bold mb-3">
                <i class="bi bi-funnel"></i> Search & Filter
            </h5>

            <form action="{{ route('tasks.index') }}" method="GET">

                <div class="row">

                    <!-- Search -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cari Tugas</label>
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Masukkan judul tugas..."
                               value="{{ request('search') }}">
                    </div>

                    <!-- Filter Status -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>

                            <option value="Pending"
                                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="In Progress"
                                {{ request('status') == 'In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="Completed"
                                {{ request('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>
                    </div>

                    <!-- Filter Prioritas -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Prioritas</label>
                        <select name="priority" class="form-select">
                            <option value="">Semua Prioritas</option>

                            <option value="Low"
                                {{ request('priority') == 'Low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="Medium"
                                {{ request('priority') == 'Medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="High"
                                {{ request('priority') == 'High' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="col-md-2 mb-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                </div>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset Filter
                </a>

            </form>

        </div>
    </div>

    <!-- Daftar Tugas -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="fw-bold mb-3">Task List</h5>

            @forelse($tasks as $task)

                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between">

                        <div>
                            <h5 class="fw-bold">{{ $task->title }}</h5>

                            <p class="text-secondary mb-2">
                                {{ $task->description ?: 'Tidak ada deskripsi.' }}
                            </p>

                            <small class="text-secondary">
                                Deadline:
                                {{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}
                            </small>
                        </div>

                        <div class="text-end">

                            <span class="badge bg-info">
                                {{ $task->priority }}
                            </span>

                            <div class="mt-2">
                                <span class="badge bg-secondary">
                                    {{ $task->status }}
                                </span>
                            </div>

                            <!-- Tombol Edit dan Delete -->
                            <div class="mt-3 d-flex gap-2">

                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <i class="bi bi-clipboard-x fs-1 text-secondary"></i>

                    <h5 class="mt-3">No Tasks Found</h5>

                    <p class="text-secondary">
                        Tidak ada tugas yang sesuai dengan pencarian atau filter.
                    </p>

                    <a href="{{ route('tasks.index') }}"
                       class="btn btn-outline-primary">
                        Reset Filter
                    </a>
                </div>

            @endforelse

        </div>
    </div>

</div>
@endsection

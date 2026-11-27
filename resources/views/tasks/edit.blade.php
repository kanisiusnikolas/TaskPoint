
@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="fw-bold">Edit Tugas</h1>
        <p class="text-secondary">
            Perbarui informasi tugas yang sudah dibuat.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Tugas</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $task->title) }}"
                           required>
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Prioritas</label>
                        <select name="priority" class="form-select" required>
                            <option value="Low" {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Deadline</label>
                        <input type="date"
                               name="due_date"
                               class="form-control"
                               value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('tasks.index') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

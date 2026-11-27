
@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="fw-bold">Tambah Tugas</h1>
        <p class="text-secondary">
            Buat tugas baru dan atur prioritas pekerjaanmu.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Tugas</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="Contoh: Menyelesaikan laporan"
                           value="{{ old('title') }}"
                           required>
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Tuliskan detail tugas...">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Prioritas</label>
                        <select name="priority" class="form-select" required>
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Deadline</label>
                        <input type="date"
                               name="due_date"
                               class="form-control"
                               value="{{ old('due_date') }}">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Simpan Tugas
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


@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Catatan</h2>
        <p class="text-muted">Perbarui catatan yang sudah dibuat.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('notes.update', $note->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Catatan</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $note->title) }}"
                        required
                    >

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi Catatan</label>
                    <textarea
                        name="content"
                        rows="8"
                        class="form-control @error('content') is-invalid @enderror"
                    >{{ old('content', $note->content) }}</textarea>

                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update Catatan
                    </button>

                    <a href="{{ route('notes.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tambah Catatan</h2>
        <p class="text-muted">Buat catatan baru.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Catatan</label>
                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}"
                           placeholder="Masukkan judul catatan"
                           required>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi Catatan</label>
                    <textarea name="content"
                              rows="8"
                              class="form-control @error('content') is-invalid @enderror"
                              placeholder="Tuliskan catatanmu di sini...">{{ old('content') }}</textarea>

                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Catatan
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

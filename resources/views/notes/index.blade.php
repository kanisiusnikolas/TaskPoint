
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">My Notes</h2>
            <p class="text-muted">Simpan catatan pentingmu di sini.</p>
        </div>

        <a href="{{ route('notes.create') }}" class="btn btn-primary">
            + Tambah Catatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $note->title }}</h5>

                        <p class="text-muted">
                            {{ Str::limit($note->content, 150) }}
                        </p>

                        <small class="text-muted">
                            {{ $note->created_at->format('d M Y') }}
                        </small>

                        <hr>

                        <div class="d-flex gap-2">
                            <a href="{{ route('notes.edit', $note->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('notes.destroy', $note->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <h5>Belum ada catatan</h5>
                        <p class="text-muted">Mulai buat catatan pertamamu.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

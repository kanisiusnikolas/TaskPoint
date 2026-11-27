
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('events.index') }}"
           class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Back to Events
        </a>

        <h3 class="fw-bold mt-3 mb-1">Add New Event</h3>
        <p class="text-muted">Tambahkan jadwal kegiatan baru.</p>
    </div>

    <!-- Form -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Event Title *
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Meeting Project"
                           required>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Deskripsi kegiatan...">{{ old('description') }}</textarea>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           class="form-control"
                           value="{{ old('location') }}"
                           placeholder="Lokasi kegiatan">
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Event Date *
                    </label>

                    <input type="date"
                           name="event_date"
                           class="form-control @error('event_date') is-invalid @enderror"
                           value="{{ old('event_date') }}"
                           required>

                    @error('event_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Waktu -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Start Time
                        </label>

                        <input type="time"
                               name="start_time"
                               class="form-control"
                               value="{{ old('start_time') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            End Time
                        </label>

                        <input type="time"
                               name="end_time"
                               class="form-control @error('end_time') is-invalid @enderror"
                               value="{{ old('end_time') }}">

                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Save Event
                    </button>

                    <a href="{{ route('events.index') }}"
                       class="btn btn-light border">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

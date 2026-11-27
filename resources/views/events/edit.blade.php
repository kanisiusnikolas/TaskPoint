
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('events.index') }}"
           class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Back to Events
        </a>

        <h3 class="fw-bold mt-3 mb-1">Edit Event</h3>
        <p class="text-muted">Perbarui informasi kegiatan kamu.</p>
    </div>

    <!-- Form -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('events.update', $event->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Event Title *
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $event->title) }}"
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
                              rows="4">{{ old('description', $event->description) }}</textarea>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           class="form-control"
                           value="{{ old('location', $event->location) }}">
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Event Date *
                    </label>

                    <input type="date"
                           name="event_date"
                           class="form-control @error('event_date') is-invalid @enderror"
                           value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}"
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
                               value="{{ old('start_time', $event->start_time ? substr($event->start_time, 0, 5) : '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            End Time
                        </label>

                        <input type="time"
                               name="end_time"
                               class="form-control @error('end_time') is-invalid @enderror"
                               value="{{ old('end_time', $event->end_time ? substr($event->end_time, 0, 5) : '') }}">

                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2 mt-3">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Update Event
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

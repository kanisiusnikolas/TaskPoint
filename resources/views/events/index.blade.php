
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">My Events</h3>
            <p class="text-muted mb-0">
                Kelola jadwal dan kegiatan kamu.
            </p>
        </div>

        <a href="{{ route('events.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Event
        </a>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Daftar Event -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="fw-bold mb-3">Event List</h5>

            @forelse($events as $event)

                <div class="d-flex justify-content-between align-items-center
                            border rounded-3 p-3 mb-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="bg-primary bg-opacity-10 text-primary
                                    rounded-3 p-3 text-center"
                             style="min-width: 65px;">

                            <div class="fw-bold fs-4">
                                {{ $event->event_date->format('d') }}
                            </div>

                            <small>
                                {{ $event->event_date->format('M') }}
                            </small>

                        </div>

                        <div>
                            <h6 class="fw-bold mb-1">
                                {{ $event->title }}
                            </h6>

                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar3"></i>
                                {{ $event->event_date->format('d F Y') }}

                                @if($event->start_time)
                                    &nbsp; | &nbsp;
                                    <i class="bi bi-clock"></i>
                                    {{ substr($event->start_time, 0, 5) }}

                                    @if($event->end_time)
                                        - {{ substr($event->end_time, 0, 5) }}
                                    @endif
                                @endif
                            </div>

                            @if($event->location)
                                <div class="text-muted small">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $event->location }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2">

                        <a href="{{ route('events.edit', $event->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('events.destroy', $event->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus event ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <i class="bi bi-calendar2-x text-muted"
                       style="font-size: 50px;"></i>

                    <h5 class="fw-bold mt-3">
                        Belum Ada Event
                    </h5>

                    <p class="text-muted">
                        Kamu belum memiliki jadwal kegiatan.
                    </p>

                    <a href="{{ route('events.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Buat Event Pertama
                    </a>

                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection

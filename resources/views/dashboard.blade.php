
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<div class="topbar">
    <div>
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="muted mb-0">
            Selamat datang kembali, {{ Auth::user()->name }}!
            Berikut ringkasan aktivitasmu.
        </p>
    </div>

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-white bg-white border rounded-circle">
            <i class="bi bi-bell"></i>
        </button>

        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                 style="width:40px;height:40px;">
                <i class="bi bi-person"></i>
            </div>

            <div class="d-none d-sm-block">
                <div class="fw-semibold small">
                    {{ Auth::user()->name }}
                </div>
                <div class="muted" style="font-size:12px;">
                    Personal
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Date -->
<div class="mb-4">
    <span class="muted">
        <i class="bi bi-calendar3 me-1"></i>
        {{ now()->format('d F Y') }}
    </span>
</div>

<!-- Statistics -->
<div class="row g-3 mb-4">

    <!-- Total Tasks -->
    <div class="col-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="muted small mb-2">Total Tasks</p>
                    <h3 class="fw-bold mb-0">{{ $totalTasks }}</h3>
                </div>
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-list-task"></i>
                </div>
            </div>
            <small class="text-success mt-3">Total pekerjaan</small>
        </div>
    </div>

    <!-- Completed -->
    <div class="col-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="muted small mb-2">Completed</p>
                    <h3 class="fw-bold mb-0">{{ $completedTasks }}</h3>
                </div>
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
            <small class="text-success mt-3">Pekerjaan selesai</small>
        </div>
    </div>

    <!-- In Progress -->
    <div class="col-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="muted small mb-2">In Progress</p>
                    <h3 class="fw-bold mb-0">{{ $inProgressTasks }}</h3>
                </div>
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <small class="text-warning mt-3">Sedang dikerjakan</small>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="col-6 col-xl-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="muted small mb-2">Upcoming Events</p>
                    <h3 class="fw-bold mb-0">{{ $upcomingEvents }}</h3>
                </div>
                <div class="stat-icon bg-info-subtle text-info">
                    <i class="bi bi-calendar-event"></i>
                </div>
            </div>
            <small class="text-info mt-3">Event mendatang</small>
        </div>
    </div>

</div>

<!-- Main Dashboard -->
<div class="row g-4">

    <!-- Tasks -->
    <div class="col-lg-7">
        <div class="card p-4 h-100">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">My Tasks</h5>
                    <small class="muted">Daftar pekerjaan terbaru</small>
                </div>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>

            @forelse($latestTasks as $task)

                <div class="task-row d-flex justify-content-between align-items-center">

                    <div>
                        <div class="fw-semibold">
                            {{ $task->title }}
                        </div>

                        <small class="muted">
                            Deadline:
                            {{ $task->due_date ? $task->due_date->format('d F Y') : '-' }}
                        </small>
                    </div>

                    <div>
                        @if($task->status == 'Completed')
                            <span class="badge bg-success-subtle text-success">
                                Completed
                            </span>
                        @elseif($task->status == 'In Progress')
                            <span class="badge bg-warning-subtle text-warning">
                                In Progress
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">
                                Pending
                            </span>
                        @endif
                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <i class="bi bi-clipboard-x fs-1 text-secondary"></i>
                    <h6 class="mt-3">Belum Ada Tugas</h6>
                    <p class="muted">
                        Tambahkan tugas pertamamu untuk memulai.
                    </p>

                    <a href="{{ route('tasks.create') }}"
                       class="btn btn-primary btn-sm">
                        Add New Task
                    </a>
                </div>

            @endforelse

        </div>
    </div>

    <!-- Events -->
    <div class="col-lg-5">
        <div class="card p-4 h-100">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Upcoming Events</h5>
                    <small class="muted">Kegiatan yang akan datang</small>
                </div>

                <a href="{{ route('events.index') }}"
                   class="btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>

            @forelse($latestEvents as $event)

                <div class="task-row d-flex align-items-center gap-3">

                    <!-- Tanggal -->
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-2 text-center"
                         style="min-width: 58px;">
                        <div class="fw-bold fs-4">
                            {{ $event->event_date->format('d') }}
                        </div>
                        <small>
                            {{ $event->event_date->format('M') }}
                        </small>
                    </div>

                    <!-- Informasi Event -->
                    <div class="flex-grow-1">
                        <div class="fw-semibold">
                            {{ $event->title }}
                        </div>

                        <small class="muted">
                            <i class="bi bi-calendar3"></i>
                            {{ $event->event_date->format('d F Y') }}
                        </small>

                        @if($event->start_time)
                            <div class="muted small">
                                <i class="bi bi-clock"></i>
                                {{ substr($event->start_time, 0, 5) }}

                                @if($event->end_time)
                                    - {{ substr($event->end_time, 0, 5) }}
                                @endif
                            </div>
                        @endif

                        @if($event->location)
                            <div class="muted small">
                                <i class="bi bi-geo-alt"></i>
                                {{ $event->location }}
                            </div>
                        @endif
                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <i class="bi bi-calendar-event fs-1 text-secondary"></i>

                    <h6 class="mt-3">Belum Ada Event</h6>

                    <p class="muted">
                        Belum ada kegiatan yang akan datang.
                    </p>

                    <a href="{{ route('events.create') }}"
                       class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i>
                        Add New Event
                    </a>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection

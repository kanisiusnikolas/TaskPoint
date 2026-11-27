@extends('layouts.app')

@section('title', 'Calendar - TaskPoint')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Calendar</h2>
            <p class="text-muted mb-0">
                Jadwal Tasks, Events, Checkpoints, dan hari libur nasional.
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- Navigasi Bulan -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <a href="{{ route('calendar.index', ['month' => $currentMonth->copy()->subMonth()->format('Y-m')]) }}"
               class="btn btn-outline-primary">
                <i class="bi bi-chevron-left"></i>
            </a>

            <div class="text-center">
                <h4 class="fw-bold mb-0">
                    {{ $currentMonth->translatedFormat('F Y') }}
                </h4>
            </div>

            <a href="{{ route('calendar.index', ['month' => $currentMonth->copy()->addMonth()->format('Y-m')]) }}"
               class="btn btn-outline-primary">
                <i class="bi bi-chevron-right"></i>
            </a>

        </div>
    </div>

    <!-- Keterangan -->
    <div class="d-flex flex-wrap gap-3 mb-3">

        <span>
            <span class="badge bg-danger">Libur Nasional</span>
        </span>

        <span>
            <span class="badge bg-warning text-dark">Cuti Bersama</span>
        </span>

        <span>
            <span class="badge bg-primary">Tasks</span>
        </span>

        <span>
            <span class="badge bg-success">Events</span>
        </span>

        <span>
            <span class="badge bg-warning text-dark">Checkpoints</span>
        </span>

    </div>

    <!-- Kalender -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-2 p-md-3">

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="text-danger">Min</th>
                            <th>Sen</th>
                            <th>Sel</th>
                            <th>Rab</th>
                            <th>Kam</th>
                            <th>Jum</th>
                            <th>Sab</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $firstDay = $currentMonth->copy()->startOfMonth();
                            $lastDay = $currentMonth->copy()->endOfMonth();

                            // Kalender dimulai dari hari Minggu
                            $calendarStart = $firstDay->copy()->startOfWeek(
                                \Carbon\Carbon::SUNDAY
                            );

                            $calendarEnd = $lastDay->copy()->endOfWeek(
                                \Carbon\Carbon::SATURDAY
                            );

                            $day = $calendarStart->copy();
                        @endphp

                        @while($day <= $calendarEnd)

                            <tr>

                                @for($i = 0; $i < 7; $i++)

                                    @php
                                        $dateKey = $day->format('Y-m-d');

                                        $isCurrentMonth = $day->month === $currentMonth->month;
                                        $isToday = $day->isToday();
                                        $isSunday = $day->dayOfWeek === 0;

                                        $items = $calendarItems->get($dateKey, collect());

                                        // Data libur nasional
                                        $nationalHoliday = $nationalHolidays[$dateKey] ?? null;

                                        // Data cuti bersama
                                        $jointLeave = $jointLeaves[$dateKey] ?? null;

                                        // Penentuan warna tanggal
                                        $isHoliday = $nationalHoliday || $isSunday;

                                        $cellClass = !$isCurrentMonth
                                            ? 'bg-light'
                                            : ($isHoliday ? 'bg-danger-subtle' : 'bg-white');
                                    @endphp

                                    <td style="height: 145px; min-width: 100px;"
                                        class="{{ $cellClass }}">

                                        <!-- Nomor Tanggal -->
                                        <div class="d-flex justify-content-end mb-2">

                                            <span class="
                                                {{ $isToday ? 'badge bg-primary rounded-circle p-2' : '' }}
                                                {{ $isHoliday && !$isToday ? 'text-danger fw-bold' : '' }}
                                                {{ !$isCurrentMonth ? 'text-muted' : '' }}
                                            ">
                                                {{ $day->day }}
                                            </span>

                                        </div>

                                        <!-- Libur Nasional -->
                                        @if($nationalHoliday)

                                            <div class="badge bg-danger text-wrap w-100 mb-1"
                                                 style="font-size: 10px;">
                                                {{ $nationalHoliday }}
                                            </div>

                                        @endif

                                        <!-- Cuti Bersama -->
                                        @if($jointLeave)

                                            <div class="badge bg-warning text-dark text-wrap w-100 mb-1"
                                                 style="font-size: 10px;">
                                                {{ $jointLeave }}
                                            </div>

                                        @endif

                                        <!-- Jadwal Tasks, Events, Checkpoints -->
                                        @foreach($items as $item)

                                            @php
                                                $badgeColor = match($item['type']) {
                                                    'Task' => 'primary',
                                                    'Event' => 'success',
                                                    'Checkpoint' => 'warning',
                                                    default => 'secondary',
                                                };
                                            @endphp

                                            <div class="badge bg-{{ $badgeColor }} text-wrap w-100 mb-1 text-start"
                                                 style="font-size: 10px;">
                                                {{ $item['title'] }}
                                            </div>

                                        @endforeach

                                    </td>

                                    @php
                                        $day->addDay();
                                    @endphp

                                @endfor

                            </tr>

                        @endwhile

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
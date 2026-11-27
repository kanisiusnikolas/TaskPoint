
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">My Checkpoints</h2>
            <p class="text-muted mb-0">
                Manage your goals and track your progress.
            </p>
        </div>

        <a href="{{ route('checkpoints.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add Checkpoint
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Daftar Checkpoints --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @forelse($checkpoints as $checkpoint)

                <div class="border rounded-3 p-3 mb-3">

                    <div class="d-flex justify-content-between
                                align-items-start flex-wrap gap-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ $checkpoint->title }}
                            </h5>

                            <p class="text-muted mb-2">
                                {{ $checkpoint->description ?: 'No description' }}
                            </p>

                            <small class="text-muted">
                                <i class="bi bi-calendar-event"></i>
                                Target:
                                {{ $checkpoint->target_date
                                    ? $checkpoint->target_date->format('d M Y')
                                    : 'Not set' }}
                            </small>
                        </div>

                        <div class="text-end">

                            @if($checkpoint->status == 'Completed')
                                <span class="badge bg-success">
                                    Completed
                                </span>
                            @elseif($checkpoint->status == 'In Progress')
                                <span class="badge bg-primary">
                                    In Progress
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            @endif

                            <div class="mt-3 d-flex gap-2">

                                <a href="{{ route('checkpoints.edit', $checkpoint->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                    Edit
                                </a>

                                <form action="{{ route('checkpoints.destroy', $checkpoint->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus checkpoint ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="text-center py-5">
                    <i class="bi bi-flag fs-1 text-muted"></i>

                    <h5 class="mt-3">No Checkpoints Yet</h5>

                    <p class="text-muted">
                        Start creating your first checkpoint!
                    </p>

                    <a href="{{ route('checkpoints.create') }}"
                       class="btn btn-primary">
                        Add Your First Checkpoint
                    </a>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection

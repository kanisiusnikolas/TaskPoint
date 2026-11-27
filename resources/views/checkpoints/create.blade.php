
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <a href="{{ route('checkpoints.index') }}"
           class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Back to Checkpoints
        </a>

        <h2 class="fw-bold mt-3">Add Checkpoint</h2>

        <p class="text-muted">
            Create a new goal and set your target.
        </p>
    </div>

    {{-- Form --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('checkpoints.store') }}"
                  method="POST">

                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Checkpoint Title
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter checkpoint title"
                           value="{{ old('title') }}"
                           required>

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              placeholder="Describe your checkpoint...">{{ old('description') }}</textarea>
                </div>

                {{-- Target Date --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Target Date
                    </label>

                    <input type="date"
                           name="target_date"
                           class="form-control @error('target_date') is-invalid @enderror"
                           value="{{ old('target_date') }}">

                    @error('target_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>

                        <option value="Pending"
                            {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="In Progress"
                            {{ old('status') == 'In Progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Completed"
                            {{ old('status') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        Save Checkpoint
                    </button>

                    <a href="{{ route('checkpoints.index') }}"
                       class="btn btn-light border">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

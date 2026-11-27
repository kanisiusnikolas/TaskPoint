
@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold">Settings</h2>
        <p class="text-muted">Manage your account preferences.</p>
    </div>

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        {{-- Edit Profile --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-person-circle fs-2 text-primary me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Edit Profile</h5>
                            <small class="text-muted">
                                Update your personal information.
                            </small>
                        </div>
                    </div>

                    <form action="{{ route('settings.profile.update') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Save Changes
                        </button>

                    </form>

                </div>
            </div>

        </div>

        {{-- Account Information --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-shield-check me-2 text-primary"></i>
                        Account Information
                    </h5>

                    <p class="text-muted small mb-1">Account Name</p>
                    <p class="fw-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <hr>

                    <p class="text-muted small mb-1">Email Address</p>
                    <p class="fw-semibold">
                        {{ auth()->user()->email }}
                    </p>

                    <hr>

                    <p class="text-muted small mb-1">Member Since</p>
                    <p class="fw-semibold mb-0">
                        {{ auth()->user()->created_at->format('d M Y') }}
                    </p>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection

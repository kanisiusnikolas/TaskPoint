<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 440px;
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0,0,0,.06);
        }

        .logo {
            color: #4f46e5;
            font-size: 35px;
        }

        .btn-primary {
            background: #4f46e5;
            border-color: #4f46e5;
        }
    </style>
</head>

<body>

<div class="register-card">

    <div class="text-center mb-4">
        <div class="logo">
            <i class="bi bi-check2-circle"></i>
        </div>

        <h3 class="fw-bold">Create Account</h3>
        <p class="text-secondary">Start organizing your activities.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name"
                class="form-control"
                value="{{ old('name') }}"
                placeholder="Nama lengkap" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email"
                class="form-control"
                value="{{ old('email') }}"
                placeholder="nama@email.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                class="form-control"
                placeholder="Minimal 8 karakter" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="form-control"
                placeholder="Ulangi password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            Create Account
        </button>
    </form>

    <div class="text-center mt-4">
        <small class="text-secondary">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="text-decoration-none">
                Login
            </a>
        </small>
    </div>

</div>

</body>
</html>

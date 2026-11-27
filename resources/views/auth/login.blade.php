
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskPoint</title>

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
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .06);
        }

        .logo {
            color: #4f46e5;
            font-size: 35px;
        }

        .btn-primary {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-primary:hover {
            background: #4338ca;
            border-color: #4338ca;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="text-center mb-4">
        <div class="logo">
            <i class="bi bi-check2-circle"></i>
        </div>

        <h3 class="fw-bold">TaskPoint</h3>
        <p class="text-secondary">Welcome back! Please login.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form login menggunakan HTTPS --}}
    <form action="{{ secure_url(route('login.process', [], false)) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                autocomplete="email"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >
        </div>

        <div class="form-check mb-4">
            <input
                type="checkbox"
                name="remember"
                class="form-check-input"
                id="remember"
            >

            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Login
        </button>
    </form>

    <div class="text-center mt-4">
        <small class="text-secondary">
            Belum memiliki akun?

            <a
                href="{{ secure_url(route('register', [], false)) }}"
                class="text-decoration-none"
            >
                Register
            </a>
        </small>
    </div>

</div>

</body>
</html>

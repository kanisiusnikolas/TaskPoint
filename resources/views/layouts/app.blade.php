
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskPoint')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #172033;
            color: white;
            padding: 25px 15px;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            padding: 0 15px;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #aeb8ca;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 6px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #293750;
            color: white;
        }

        .sidebar a i {
            font-size: 18px;
        }

        .menu-label {
            color: #718096;
            font-size: 11px;
            font-weight: bold;
            padding: 20px 15px 8px;
            text-transform: uppercase;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .user-info {
            position: fixed;
            right: 30px;
            bottom: 20px;
            font-size: 13px;
            color: #6c757d;
            text-align: right;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 20px 10px;
            }

            .brand {
                font-size: 15px;
                padding: 0 5px;
            }

            .sidebar a {
                justify-content: center;
                padding: 12px 5px;
            }

            .sidebar a span,
            .menu-label {
                display: none;
            }

            .main-content {
                margin-left: 75px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="brand">
            <i class="bi bi-check2-circle"></i> TaskPoint
        </div>

        <div class="menu-label">Main Menu</div>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <!-- My Tasks -->
        <a href="{{ route('tasks.index') }}"
           class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">
            <i class="bi bi-check2-square"></i>
            <span>My Tasks</span>
        </a>

        <div class="menu-label">Workspace</div>

        <!-- Events -->
        <a href="{{ route('events.index') }}"
           class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i>
            <span>Events</span>
        </a>

        <!-- Checkpoints -->
        <a href="{{ route('checkpoints.index') }}"
           class="{{ request()->routeIs('checkpoints.*') ? 'active' : '' }}">
            <i class="bi bi-flag"></i>
            <span>Checkpoints</span>
        </a>

        <!-- My Notes -->
        <a href="{{ route('notes.index') }}"
           class="{{ request()->routeIs('notes.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i>
            <span>My Notes</span>
        </a>

        <!-- Calendar -->
        <a href="{{ route('calendar.index') }}"
           class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i>
            <span>Calendar</span>
        </a>

        <div class="menu-label">Account</div>

        <!-- Settings -->
        <a href="{{ route('settings.index') }}"
           class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="btn text-start w-100 mt-2"
                    style="color: #aeb8ca;">
                <i class="bi bi-box-arrow-left me-2"></i>
                Logout
            </button>
        </form>

    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- User Information -->
    <div class="user-info">
        <strong>{{ Auth::user()->name }}</strong><br>
        {{ Auth::user()->email }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

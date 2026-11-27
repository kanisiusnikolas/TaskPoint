<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Guest: belum login
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

// Harus login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {

        $user = Auth::user();

        // Statistik tugas
        $totalTasks = $user->tasks()->count();

        $completedTasks = $user->tasks()
            ->where('status', 'Completed')
            ->count();

        $inProgressTasks = $user->tasks()
            ->where('status', 'In Progress')
            ->count();

        // Empat tugas terbaru
        $latestTasks = $user->tasks()
            ->latest()
            ->take(4)
            ->get();

        // Menghitung event yang akan datang
        $upcomingEvents = $user->events()
            ->whereDate('event_date', '>=', today())
            ->count();

        // Mengambil tiga event terdekat
        $latestEvents = $user->events()
            ->whereDate('event_date', '>=', today())
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'inProgressTasks',
            'upcomingEvents',
            'latestTasks',
            'latestEvents'
        ));

    })->name('dashboard');

    // My Tasks (CRUD)
    Route::resource('tasks', TaskController::class);

    // Events (CRUD)
    Route::resource('events', EventController::class);

    // Checkpoints (CRUD)
    Route::resource('checkpoints', CheckpointController::class);

    // My Notes (CRUD)
    Route::resource('notes', NoteController::class);

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar.index');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    // Update Profile
    Route::put('/settings/profile', [SettingController::class, 'updateProfile'])
        ->name('settings.profile.update');

    // Update Password
    Route::put('/settings/password', [SettingController::class, 'updatePassword'])
        ->name('settings.password.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});

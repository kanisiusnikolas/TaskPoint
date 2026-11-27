<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Models\Checkpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'month' => 'nullable|date_format:Y-m',
        ]);

        $currentMonth = Carbon::createFromFormat(
            'Y-m',
            $request->input('month', now()->format('Y-m'))
        )->startOfMonth();

        $startDate = $currentMonth->copy()->startOfMonth();
        $endDate = $currentMonth->copy()->endOfMonth();

        // Mengambil My Tasks
        $tasks = Task::where('user_id', Auth::id())
            ->whereBetween('due_date', [$startDate, $endDate])
            ->get()
            ->map(function ($task) {
                return [
                    'title' => $task->title,
                    'date' => $task->due_date->format('Y-m-d'),
                    'type' => 'Task',
                    'status' => $task->status,
                ];
            });

        // Mengambil Events
        $events = Event::where('user_id', Auth::id())
            ->whereBetween('event_date', [$startDate, $endDate])
            ->get()
            ->map(function ($event) {
                return [
                    'title' => $event->title,
                    'date' => $event->event_date->format('Y-m-d'),
                    'type' => 'Event',
                    'status' => 'Event',
                ];
            });

        // Mengambil Checkpoints
        $checkpoints = Checkpoint::where('user_id', Auth::id())
            ->whereBetween('target_date', [$startDate, $endDate])
            ->get()
            ->map(function ($checkpoint) {
                return [
                    'title' => $checkpoint->title,
                    'date' => $checkpoint->target_date->format('Y-m-d'),
                    'type' => 'Checkpoint',
                    'status' => $checkpoint->status,
                ];
            });

        // Menggabungkan semua jadwal
        $calendarItems = $tasks
            ->concat($events)
            ->concat($checkpoints)
            ->groupBy('date');

        // Mengambil data hari libur
        $nationalHolidays = config('holidays.national', []);
        $jointLeaves = config('holidays.joint_leave', []);

        return view('calendar.index', compact(
            'currentMonth',
            'calendarItems',
            'nationalHolidays',
            'jointLeaves'
        ));
    }
}

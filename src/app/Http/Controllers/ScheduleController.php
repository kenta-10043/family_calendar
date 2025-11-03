<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeek;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Schedule;


class ScheduleController extends Controller
{
    public function calendar(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : now();
        $targetUser = Auth::user();
        $users = User::whereHas('schedules', function ($query) {
            $query->whereNotNull('task')->where('task', '');
        })->get();
        $schedule = Schedule::where('schedule_date', $date)->first();

        $calendar = new CalendarView($date);
        $title = $calendar->getTitle();
        $weeks = $calendar->getWeeks();
        $currentMonth = $calendar->getDate();

        $next = $currentMonth->copy()->addMonth();
        $prev = $currentMonth->copy()->subMonth();

        return view(
            'schedules.schedule',
            compact('schedule', 'targetUser', 'users', 'title', 'weeks', 'currentMonth', 'next', 'prev')
        );
    }

    public function detail($id = null)
    {
        $schedule = $id ? Schedule::find($id) : null;
        $date = $schedule->schedule_date ?? '';
        $targetUser = Auth::user();
        $users = User::whereHas('schedules', function ($query) {
            $query->whereNotNull('task')->where('task', '');
        })->get();

        $calendar = new CalendarView(Carbon::parse($date));
        $title = $calendar->getTitle();
        $currentDay = $calendar->getDate();

        $next = $currentDay->copy()->addDay();
        $prev = $currentDay->copy()->subDay();

        return view(
            'schedules.schedule_detail',
            compact('schedule', 'targetUser', 'users', 'title', 'currentDay', 'next', 'prev')
        );
    }
}

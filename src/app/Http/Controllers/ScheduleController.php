<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeek;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function calendar(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : now();

        $calendar = new CalendarView($date);
        $title = $calendar->getTitle();
        $weeks = $calendar->getWeeks();
        $currentMonth = $calendar->getDate();

        $next = $currentMonth->copy()->addMonth();
        $prev = $currentMonth->copy()->subMonth();

        return view(
            'schedules.schedule',
            compact('title', 'weeks', 'currentMonth', 'next', 'prev')
        );
    }
}

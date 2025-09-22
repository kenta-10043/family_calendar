<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeek;

class ScheduleController extends Controller
{
    public function calendar()
    {
        $calendar = new CalendarView();
        $title = $calendar->getTitle();
        $weeks = $calendar->getWeeks();

        return view(
            'schedules.schedule',
            compact('title', 'weeks')
        );
    }
}

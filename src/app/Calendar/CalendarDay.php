<?php

namespace App\Calendar;

use App\Calendar\CalendarView;
use App\Calendar\CalendarWeek;
use Carbon\Carbon;

class CalendarDay
{
    public $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    public function isToday(): bool
    {
        return $this->date->isToday();
    }

    public function isSameMonth($currentMonth): bool
    {
        return $this->date->isSameMonth($currentMonth);
    }
}

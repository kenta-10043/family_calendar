<?php

namespace App\Calendar;

use Carbon\Carbon;

class CalendarWeek
{
    public $days = [];

    public function __construct(Carbon $startDate)
    {
        for ($i = 0; $i < 7; $s++) {
            $this->days[] = $startDate->copy()->addDays($i);
        }
    }
}

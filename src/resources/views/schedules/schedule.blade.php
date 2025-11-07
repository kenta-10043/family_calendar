@extends('layouts.app')

@section('title', 'Family Calendar')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule/schedule.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="calendar-name">{{ $title }}</h2>
        <div class="link__month">
            <a class="link__previous" href="{{ route('schedule.calendar', ['date' => $prev->format('Y-m')]) }}">◀previous
                month</a>
            <a class="link__this" href="{{ route('schedule.calendar') }}">-this month-</a>
            <a class="link__next" href="{{ route('schedule.calendar', ['date' => $next->format('Y-m')]) }}">next month▶</a>
        </div>

        <div class="calendar__main">
            <div class="day-name">Sun</div>
            <div class="day-name">Mon</div>
            <div class="day-name">Tue</div>
            <div class="day-name">Wed</div>
            <div class="day-name">Thu</div>
            <div class="day-name">Fri</div>
            <div class="day-name">Sat</div>

            @foreach ($weeks as $week)
                @foreach ($week->days as $day)
                    <div
                        class="day__box{{ $day->isToday() ? ' day__box-today' : '' }} {{ $day->isSameMonth($currentMonth) ? '' : ' day__box-other-month' }}">
                        {{-- クラスを複数つけるときは半角スペース区切り、条件付きCSSの場合はクラス名の先頭に半角スペース --}}
                        {{ $day->date->format('j') }}

                        @php
                            $schedules = $calendarSchedules[$day->date->format('Y-m-d')] ?? collect();
                        @endphp
                        <a class="link__detail"
                            href="{{ route('schedule.detail', ['id' => $schedules->first()->id ?? null, 'date' => $day->date->format('Y-m-d')]) }}">more</a>
                        @forelse ($schedules as $schedule)
                            @foreach ($schedule->users as $user)
                                <p class="schedule__items">{{ $user->name }}：{{ $schedule->task }}</p>
                            @endforeach
                        @empty
                        @endforelse


                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'schedule_detail')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule/detail.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="calendar-name">{{ $title->isoFormat('Y / m / d(ddd)') }}</h2>
        <div class="link__month">
            <a class="link__previous" href="{{ route('schedule.detail', ['date' => $prev->format('Y/m/d(ddd)')]) }}">◀previous
                day</a>
            <a class="link__this" href="{{ route('schedule.detail') }}">-this day-</a>
            <a class="link__next" href="{{ route('schedule.detail', ['date' => $next->format('Y/m/d(ddd)')]) }}">next day▶</a>
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
                        @foreach ($users as $user)
                            <p>{{ $user->name }}:{{ $user->schedules->task }}</p>
                        @endforeach
                        <a href="{{ route('schedule.detail', ['id' => $schedule->id ?? null]) }}">more</a>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
@endsection

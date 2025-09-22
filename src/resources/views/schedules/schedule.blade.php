@extends('layouts.app')

@section('title', 'Family Calendar')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="calendar-name">{{ $title }}</h2>

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
                    <div class="day__box{{ $day->isToday() ? ' today' : '' }}">
                        {{ $day->date->format('j') }}</div>
                @endforeach
            @endforeach

        </div>
    </div>
@endsection

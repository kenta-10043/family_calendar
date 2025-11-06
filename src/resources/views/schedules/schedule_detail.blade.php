@extends('layouts.app')

@section('title', 'schedule_detail')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule/detail.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="calendar-name">{{ $date->isoFormat('Y年MM月DD日(ddd)') }}</h2>

        <div class="link__month">
            <a class="link__previous" href="{{ route('schedule.detail', ['date' => $prev->format('Y-m-d')]) }}">◀previous
                day</a>
            <a class="link__this" href="{{ route('schedule.detail') }}">-this day-</a>
            <a class="link__next" href="{{ route('schedule.detail', ['date' => $next->format('Y-m-d')]) }}">next
                day▶</a>
        </div>

        <div>

        </div>




    </div>

@endsection

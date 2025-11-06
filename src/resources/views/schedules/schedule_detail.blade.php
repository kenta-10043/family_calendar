@extends('layouts.app')

@section('title', 'schedule_detail')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule/detail.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="calendar-name">{{ $date->isoFormat('Y年MM月DD日(ddd)') }}</h2>

        <div class="link__day">
            <a class="link__previous" href="{{ route('schedule.detail', ['date' => $prev->format('Y-m-d')]) }}">◀previous
                day</a>
            <a class="link__this" href="{{ route('schedule.detail') }}">-this day-</a>
            <a class="link__next" href="{{ route('schedule.detail', ['date' => $next->format('Y-m-d')]) }}">next
                day▶</a>
        </div>

        <div class="schedule__content">
            <form class="schedule__form" action="#" method="POST">
                @csrf

                <div class="schedule__item-name">
                    <p>name</p>
                    @foreach ($schedules as $schedule)
                        @foreach ($schedule->users as $user)
                            <p>{{ $user->name }}</p>
                        @endforeach
                    @endforeach
                    <label for="name">追加</label>
                    <input type="text" id="name" name='name' value="{{ old('name') }}"
                        placeholder="名前を入力してください">
                </div>

                <div class="schedule__item-task">
                    <p>task</p>
                    @foreach ($schedules as $schedule)
                        <p>{{ $schedule->task }}</p>
                    @endforeach
                    <label for="task">追加</label>
                    <input type="text" id="task" name='task' value="{{ old('task') }}"
                        placeholder="予定を入力してください">
                </div>

                <div class="schedule__item-category">
                    <p>category</p>

                </div>

                <div class="schedule__item-status">
                    <p>status</p>
                </div>
            </form>
        </div>




    </div>

@endsection

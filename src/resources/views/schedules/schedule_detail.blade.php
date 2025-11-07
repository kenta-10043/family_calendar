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

        <form class="schedule__form" action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="schedule__content">
                <div class="schedule__item-name">
                    <p>name</p>
                    @foreach ($schedules as $schedule)
                        @foreach ($schedule->users as $user)
                            <div class="user__profile">
                                <img class="user__image" src="{{ asset('storage/' . $user->user_image) }}"
                                    alt="{{ $targetUser->name }}">
                                <p>{{ $user->name }}</p>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="user__profile">
                        <img class="user__image" src="{{ asset('storage/' . $targetUser->user_image) }}"
                            alt="{{ $targetUser->name }}">
                        <p>{{ $targetUser->name }}</p>
                    </div>
                    <input type="hidden" id="name" name="user_id" value="{{ $targetUser->id }}">

                </div>

                <div class="schedule__item-task">
                    <p>task</p>
                    @foreach ($schedules as $schedule)
                        <p>{{ $schedule->task }}</p>
                    @endforeach

                    <label for="task">追加</label>
                    <input type="text" id="task" name='task' value="{{ old('task') }}"
                        placeholder="予定を入力してください">

                    @error('task')
                        <div class="error-alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="schedule__item-category">
                    <p>category</p>
                    @foreach ($schedules as $schedule)
                        <p>{{ $schedule->category->label }}</p>
                    @endforeach

                    <label for="category">追加</label>
                    <select name="category_id" id="category">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選んでください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->label }}
                            </option>
                        @endforeach
                    </select>

                    @error('category')
                        <div class="error-alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="schedule__item-status">
                    <p>status</p>
                    @foreach ($schedules as $schedule)
                        <p>{{ $schedule->status->label }}</p>
                    @endforeach
                </div>
                <input type="hidden" name="status_id" value="{{ $status->id }}">
            </div>
            <input type="hidden" name="date" value="{{ request('date') ?? now()->format('Y-m-d') }}">
            <div class="button__area">
                <button type="submit">登録</button>
            </div>
        </form>

    </div>

@endsection

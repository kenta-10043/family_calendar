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

        <table class="schedule__table">
            <tr class="table__items-main">
                <th>name</th>
                <th>task</th>
                <th>category</th>
                <th>status</th>
            </tr>

            @foreach ($schedules as $schedule)
                <tr class="table__items">
                    @foreach ($schedule->users as $user)
                        <td class="user__profile">
                            <img class="user__image" src="{{ asset('storage/' . $user->user_image) }}"
                                alt="{{ $targetUser->name }}">
                            <p>{{ $user->name }}</p>
                        </td>
                    @endforeach

                    <td class="schedule__item-task">
                        <p class=item-task>{{ $schedule->task }}</p>
                    </td>

                    <td class="schedule__item-category">
                        <p class="item-category">{{ $schedule->category->label }}</p>
                    </td>

                    <td class="schedule__item-status">
                        <p class="item-status">{{ $schedule->status->label }}</p>
                    </td>
                    @if ($schedule->users->contains($targetUser))
                        <td>
                            <form action="{{ route('schedule.update', ['id' => $schedule->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($schedule->status_id == 1)
                                    <input type="hidden" name="status_id" value=2>
                                    <button type="submit">Completed！！</button>
                                @elseif($schedule->status_id == 2)
                                    <input type="hidden" name="status_id" value="1">
                                    <button type="submit" class="btn btn-incomplete">Incomplete</button>
                                @endif
                                <input type="hidden" name="date" value="{{ $date->toDateString() }}">
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach

            <form class="schedule__form" action="{{ route('schedule.store') }}" method="POST">
                @csrf
                <tr class="table__items">
                    <td class="user__profile">
                        <img class="user__image" src="{{ asset('storage/' . $targetUser->user_image) }}"
                            alt="{{ $targetUser->name }}">
                        <p>{{ $targetUser->name }}</p>
                    </td>
                    <input type="hidden" id="name" name="user_id" value="{{ $targetUser->id }}">

                    <td>
                        <div class="item-task">
                            <label for="task">追加</label>
                            <input type="text" id="task" name='task' value="{{ old('task') }}"
                                placeholder="予定を入力してください">

                            @error('task')
                                <div class="error-alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>

                    <td>
                        <div class="item-category-add">
                            <label for="category">追加</label>
                            <select name="category_id" id="category">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選んでください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->label }}
                                    </option>
                                @endforeach
                                @error('category')
                                    <div class="error-alert">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                    </td>
                    <input type="hidden" name="status_id" value="{{ $status->id }}">
                    <input type="hidden" name="date" value="{{ request('date') ?? now()->format('Y-m-d') }}">

                </tr>
        </table>
        <div class="button__area">
            <button type="submit">登録</button>
        </div>
        </form>


    </div>

@endsection

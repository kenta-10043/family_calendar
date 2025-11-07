<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeek;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleRequest;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Category;
use App\Models\Status;
use App\Enums\CategoryName;
use App\Enums\TaskStatus;



class ScheduleController extends Controller
{
    public function calendar(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : now();
        $calendar = new CalendarView($date);
        $title = $calendar->getTitle()->format('Y年n月');
        $weeks = $calendar->getWeeks();
        $days = new CalendarWeek($date);
        $currentMonth = $calendar->getDate();
        $next = $currentMonth->copy()->addMonth();
        $prev = $currentMonth->copy()->subMonth();

        $targetUser = Auth::user();

        $monthStart = $currentMonth->copy()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $monthEnd   = $currentMonth->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        foreach ($days->days as $day) {
            $users = User::whereHas('schedules', function ($query) use ($day) {
                $query->whereDate('date', $day->date)->whereNotNull('task')->where('task', '!=', '');
            })->get();
        } //schedulesテーブルに指定された日に日付が入っていてタスクがありそれが空文字でないユーザー

        $allSchedules = Schedule::with('users')
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get();

        $calendarSchedules = $allSchedules->groupBy(fn($scheduleDate) => Carbon::parse($scheduleDate->date)->format('Y-m-d'));
        // 日付ごとにグループ化 （2025-11-06=>collection([schedule(id:1)]のような感じ

        return view(
            'schedules.schedule',
            compact('calendarSchedules', 'targetUser', 'users', 'title', 'weeks', 'currentMonth', 'next', 'prev', 'date')
        );
    }

    public function detail(Request $request, $id = null)
    {
        $schedule = $id ? Schedule::find($id) : null;
        $date = $request->query('date') ? Carbon::parse($request->query('date')) : now();

        $next = $date->copy()->addDay();
        $prev = $date->copy()->subDay();

        $targetUser = Auth::user();

        $schedules =  Schedule::with('users', 'status', 'category')->whereDate('date', $date)->whereNotNull('task')->where('task', '!=', '')->get();

        $categories = Category::all();
        $status = Status::find(1);

        return view(
            'schedules.schedule_detail',
            compact('date', 'schedules', 'targetUser', 'next', 'prev', 'categories', 'status')
        );
    }

    public function store(ScheduleRequest $request)
    {
        $data = $request->validated();
        $schedule = Schedule::create([
            'task' => $data['task'],
            'category_id' => $data['category_id'],
            'status_id' => $data['status_id'],
            'date' => $data['date'],

        ]);

        $schedule->users()->attach($data['user_id']);


        return redirect(route('schedule.calendar'));
    }
}

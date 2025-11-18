<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Diary;
use Carbon\Carbon;
use App\Http\Requests\DiaryRequest;
use Illuminate\Support\Facades\Redirect;

class DiaryController extends Controller
{
    public function index(Request $request)
    {
        $targetUser = Auth::user();
        $diaryDate = Carbon::parse($request->input('date'))->isoFormat('YYYY年MM月DD日（ddd）') ?? Carbon::now()->isoFormat('YYYY年MM月DD日（ddd）');

        $diaries = Diary::with('user')->where('user_id', $targetUser->id)->orderBy('date', 'desc')->paginate(3);
        return view('diaries.diary', compact('diaryDate', 'targetUser', 'diaries'));
    }

    public function store(DiaryRequest $request)
    {
        $user = Auth()->user();
        $diary = $request->validated();
        Diary::create([
            'user_id' => $user->id,
            'date' => $diary['date'],
            'title' => $diary['title'],
            'content' => $diary['content'],
        ]);

        return redirect()->route('diary.index')->with('success', "日記の登録が完了しました");
    }
}

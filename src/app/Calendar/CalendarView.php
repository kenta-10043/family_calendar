<?php

namespace App\Calendar;

use Carbon\Carbon;


class CalendarView
{
    protected $carbon;

    public function __construct(?Carbon $date = null)   // nullで日付がなかった場合には本日を呼ぶ
    {
        $this->carbon = $date ? $date->copy()->startOfMonth() : now()->startOfMonth();  //carbonのインスタンス生成 表示するカレンダー
    }

    // このカレンダーの基準月を返す
    public function getDate(): Carbon
    {
        return $this->carbon->copy();
    }

    public function getTitle()  //カレンダーのタイトル作成
    {
        return $this->carbon;
    }

    public function getWeeks()  //1か月を１週間の集まりとして生成
    {
        $weeks = [];

        $start = $this->carbon->copy()->startOfMonth();     //1か月の最初の日付
        $start->startOfWeek(Carbon::SUNDAY);              //最初の日付が入っている週の日曜日を開始にする

        $end = $this->carbon->copy()->endOfMonth();         //１か月の終わりの日付
        $end->endOfWeek(Carbon::SATURDAY);                //最後の日付が入っている週の土曜日を終了にする

        for ($date = $start->copy(); $date->lte($end); $date->addWeek()) {
            $weeks[] = new CalendarWeek($date->copy());
        }  //ループで初期値を一か月の最初、それが一か月終わりまで（less than of equal1=以下)の間、一週間を足しながら継続し、CalendarWeekクラスに渡す

        return $weeks;
    }
}

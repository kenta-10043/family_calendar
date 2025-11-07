<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasks = [
            '顧客との打ち合わせ',
            '資料作成',
            '在庫チェック',
            '新商品ミーティング',
            '店舗巡回',
            'システムメンテナンス',
            '会議準備',
        ];


        return [
            'category_id' => 1,
            'status_id' => 1,
            'task' => $this->faker->randomElement($tasks),
            'date' => Carbon::now()->addDays(rand(0, 30)),
        ];
    }
}

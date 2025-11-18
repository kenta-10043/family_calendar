<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Diary;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StatusSeeder::class);
        $this->call(CategorySeeder::class);

        User::factory()->count(3)->hasAttached(
            Schedule::factory()->count(5),
        )->create();

        $user = User::create([
            'name' => 'gonta',
            'email' => 'gon@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        Diary::factory()->count(10)->for($user)->create();
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Diary;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $targetUser = auth()->user();
            $latestDiary = Diary::with('user')
                ->where('user_id', $targetUser->id)
                ->latest('date')
                ->first();

            $view->with('latestDiary', $latestDiary);
        });
    }
}

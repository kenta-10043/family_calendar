<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ScheduleController::class, 'calendar'])->name('schedule.calendar');
Route::get('/schedule/detail', [ScheduleController::class, 'detail'])->name('schedule.detail');
Route::post('/schedule/detail/store', [ScheduleController::class, 'store'])->name('schedule.store');
Route::put('/schedule/detail/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');

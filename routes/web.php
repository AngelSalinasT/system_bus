<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BranchController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('users', UserController::class);
Route::resource('buses', BusController::class);
Route::resource('routes', RouteController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('tickets', TicketController::class);
Route::resource('branches', BranchController::class);

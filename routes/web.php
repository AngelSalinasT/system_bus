<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BranchController;

Route::middleware([
    'auth:sanctum', // Asegura que el usuario esté autenticado mediante Sanctum
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta de dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas que necesitan autenticación
    Route::resource('users', UserController::class);
    Route::resource('buses', BusController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('branches', BranchController::class);
});

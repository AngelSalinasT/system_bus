<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BranchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::apiResource('users', UserController::class);

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BranchController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'ability:create-post'])->get('/post/create', function (Request $request) {
    return [
        'id' => 1,
        'title' => $request->title,
        'content' => $request->content,
    ];
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('users', [UserController::class, 'apiIndex']);
    Route::apiResource('users', UserController::class)->except('index');
    Route::get('schedules', [UserController::class, 'apiIndex']);
    Route::apiResource('schedules', ScheduleController::class)->except('index');
    Route::get('tickets', [UserController::class, 'apiIndex']);
    Route::apiResource('tickets', TicketController::class)->except('index');
    Route::get('routes', [UserController::class, 'apiIndex']);
    Route::apiResource('routes', RouteController::class)->except('index');
    Route::get('buses', [UserController::class, 'apiIndex']);
    Route::apiResource('buses', BusController::class)->except('index');
    Route::get('branches', [UserController::class, 'apiIndex']);
    Route::apiResource('branches', BranchController::class)->except('index');

    Route::post('/login', function (Request $request) {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ],
            'token' => $user->createToken('api')->plainTextToken,
        ]);

    });

});

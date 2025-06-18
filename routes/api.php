<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CoupomController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\CountController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/cont', [CountController::class, 'contagens']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('category', CategoryController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('coupom', CoupomController::class);
    Route::apiResource('reminder', ReminderController::class);


    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});

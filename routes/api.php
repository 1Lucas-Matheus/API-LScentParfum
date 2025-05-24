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

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('categorias', CategoryController::class);
    Route::apiResource('perfumes', ProductController::class);
    Route::apiResource('cupons', CoupomController::class);
    Route::apiResource('lembretes', ReminderController::class);

    Route::get('/resumo', [CountController::class, 'contagens']);

    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
// });

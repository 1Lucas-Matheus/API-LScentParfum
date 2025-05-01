<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PerfumeController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\LembreteController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('perfumes', PerfumeController::class);
    Route::apiResource('cupons', CupomController::class);
    Route::apiResource('lembretes', LembreteController::class);

});

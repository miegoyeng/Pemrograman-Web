<?php

use App\Http\Controllers\FighterController;
use App\Http\Controllers\ViewerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('viewers', ViewerController::class);
Route::apiResource('fighters',FighterController::class);

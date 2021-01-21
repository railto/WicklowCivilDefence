<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchTeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', RegisterController::class);
Route::post('/auth/login', LoginController::class);

Route::get('/search', [SearchController::class, 'list']);
Route::post('/search', [SearchController::class, 'store']);
Route::get('/search/{search}', [SearchController::class, 'view']);
Route::post('/search/{search}/teams', [SearchTeamController::class, 'store']);
Route::put('/search/{search}/teams/{team}', [SearchTeamController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

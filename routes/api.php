<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Search\SearchLogController;
use App\Http\Controllers\SearchCommsLogController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchRadioAssignmentController;
use App\Http\Controllers\SearchTeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/auth/register', RegisterController::class);
    Route::post('/auth/login', LoginController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/search', [SearchController::class, 'list']);
    Route::post('/search', [SearchController::class, 'store']);
    Route::get('/search/{search}', [SearchController::class, 'view']);

    Route::post('/search/{search}/teams', [SearchTeamController::class, 'store']);
    Route::put('/search/{search}/teams/{team}', [SearchTeamController::class, 'update']);

    Route::post('/search/{search}/radios', [SearchRadioAssignmentController::class, 'store']);

    Route::post('/search/{search}/logs/comms', [SearchCommsLogController::class, 'store']);

    Route::post('/search/{search}/logs/search', [SearchLogController::class, 'store']);
    Route::put('/search/{search}/logs/search/{log}', [SearchLogController::class, 'update']);
});

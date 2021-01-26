<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Search\SearchLogController;
use App\Http\Controllers\Search\CommsLogController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Search\RadioAssignmentController;
use App\Http\Controllers\Search\TeamController;
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

    Route::get('/searches', [SearchController::class, 'list']);
    Route::post('/searches', [SearchController::class, 'store']);
    Route::get('/searches/{search}', [SearchController::class, 'view']);
    Route::post('/searches/{search}/end', [SearchController::class, 'end']);

    Route::post('/searches/{search}/teams', [TeamController::class, 'store']);
    Route::put('/searches/{search}/teams/{team}', [TeamController::class, 'update']);

    Route::post('/searches/{search}/radios', [RadioAssignmentController::class, 'store']);

    Route::post('/searches/{search}/logs/comms', [CommsLogController::class, 'store']);

    Route::post('/searches/{search}/logs/search', [SearchLogController::class, 'store']);
    Route::put('/searches/{search}/logs/search/{log}', [SearchLogController::class, 'update']);
});

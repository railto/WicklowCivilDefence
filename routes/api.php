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

    Route::get('/searches', [SearchController::class, 'list']);
    Route::post('/searches', [SearchController::class, 'store']);
    Route::get('/searches/{search}', [SearchController::class, 'view']);
    Route::post('/searches/{search}/end', [SearchController::class, 'end']);

    Route::post('/searches/{search}/teams', [SearchTeamController::class, 'store']);
    Route::put('/searches/{search}/teams/{team}', [SearchTeamController::class, 'update']);

    Route::post('/searches/{search}/radios', [SearchRadioAssignmentController::class, 'store']);

    Route::post('/searches/{search}/logs/comms', [SearchCommsLogController::class, 'store']);

    Route::post('/searches/{search}/logs/searches', [SearchLogController::class, 'store']);
    Route::put('/searches/{search}/logs/searches/{log}', [SearchLogController::class, 'update']);
});

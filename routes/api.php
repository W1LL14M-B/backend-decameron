<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\hotelsController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/hotels')->group(function () {
    Route::get('/',[ hotelsController::class, 'get']);
    Route::post('/',[ hotelsController::class, 'create']);
    Route::get('/{id}',[ hotelsController::class, 'getById']);
    Route::put('/{id}',[ hotelsController::class, 'update']);
    Route::delete('/{id}',[ hotelsController::class, 'delete']);
});

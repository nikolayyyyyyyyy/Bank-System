<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientControllerApi;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Client API routes
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientControllerApi::class, 'index']);
    Route::get('/{id}', [ClientControllerApi::class, 'show']);
    Route::post('/', [ClientControllerApi::class, 'store']);
    Route::put('/{id}/update', [ClientControllerApi::class, 'update']);
    Route::delete('/{id}/delete', [ClientControllerApi::class, 'destroy']);
});
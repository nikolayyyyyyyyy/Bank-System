<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientControllerApi;
use App\Http\Controllers\Api\EmployeeControllerApi;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountControllerApi;
use App\Http\Controllers\Api\TransactionControllerApi;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Client API routes
Route::prefix('clients')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ClientControllerApi::class, 'index']);
    Route::get('/{id}', [ClientControllerApi::class, 'show']);
    Route::post('/', [ClientControllerApi::class, 'store']);
    Route::put('/{id}/update', [ClientControllerApi::class, 'update']);
    Route::delete('/{id}/delete', [ClientControllerApi::class, 'destroy']);
});

// Employee API routes
Route::prefix('employees')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [EmployeeControllerApi::class, 'index']);
    Route::get('/{id}', [EmployeeControllerApi::class, 'show']);
    Route::post('/', [EmployeeControllerApi::class, 'store']);
    Route::put('/{id}/update', [EmployeeControllerApi::class, 'update']);
    Route::delete('/{id}/delete', [EmployeeControllerApi::class, 'destroy']);
});

// Account API routes
Route::prefix('accounts')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AccountControllerApi::class, 'index']);
    Route::get('/{id}', [AccountControllerApi::class, 'show']);
    Route::post('/', [AccountControllerApi::class, 'store']);
    Route::put('/{id}/update', [AccountControllerApi::class, 'update']);
    Route::delete('/{id}/delete', [AccountControllerApi::class, 'destroy']);
});

// Transaction API routes
Route::prefix('transactions')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TransactionControllerApi::class, 'index']);
    Route::get('/{id}', [TransactionControllerApi::class, 'show']);
    Route::post('/', [TransactionControllerApi::class, 'store']);
    Route::put('/{id}/update', [TransactionControllerApi::class, 'update']);
    Route::delete('/{id}/delete', [TransactionControllerApi::class, 'destroy']);
});
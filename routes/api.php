<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');

    //Authentication Section
    Route::post('/login', [LoginController::class, 'login'])->middleware('incremental.block');
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/register', [RegisterController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('/inventories', InventoryController::class);
        Route::apiResource('/inventories/{inventory}/inventoryItems', InventoryItemController::class);
    });
});

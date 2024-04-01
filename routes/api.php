<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/v1')->group(function () {

    //Auth routes

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/inventories', InventoryController::class);
        Route::apiResource('/inventories/{inventory}/inventoryItems', InventoryItemController::class);
    });
});

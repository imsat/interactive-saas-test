<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    //Auth routes
    Route::post("/register", [UserController::class, "register"]);
    Route::post("/login", [UserController::class, "login"]);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post("/logout", [UserController::class, "logout"]);

        Route::apiResource('/inventories', InventoryController::class);
        Route::apiResource('/inventories/{inventory}/inventoryItems', InventoryItemController::class);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index']); // Get all menus
        Route::post('/', [MenuController::class, 'store']); // Create a new menu
        Route::get('/{id}', [MenuController::class, 'show']); // Get specific menu
        Route::get('/{id}/items', [MenuItemController::class, 'getMenuItems']); // Show items hierarchically
    });
    
    Route::prefix('menu-items')->group(function () {
        Route::post('/{menuId}', [MenuItemController::class, 'addItem']); // Add item hierarchically
        Route::put('/{id}', [MenuItemController::class, 'update']); // Update item
        Route::delete('/{id}', [MenuItemController::class, 'destroy']); // Delete item
    });
});
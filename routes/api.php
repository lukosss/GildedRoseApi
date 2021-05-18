<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Items
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'showItemsFromCategoryById']);

Route::prefix('/item')->group( function() {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

// Categories
Route::get('/categories', [CategoryController::class, 'index']);

Route::prefix('/category')->group( function() {
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
    Route::get('/{categoryName}', [CategoryController::class, 'showItemsFromCategoryByName']);
    Route::delete('/deleteItemsFromCategoryName/{categoryName}', [CategoryController::class, 'destroyAllItemsFromCategory']);
    Route::delete('/deleteItemsFromCategoryId/{categoryId}', [CategoryController::class, 'destroyAllItemsFromCategoryId']);
});

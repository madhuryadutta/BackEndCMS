<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('viewAllCategory');
    Route::get('/category/{id}', 'show')->name('viewCategory');
    Route::post('/category', 'store')->name('addCategory');
    Route::put('/category/{id?}', 'update')->name('editCategory');
    Route::delete('/category/{id?}', 'destroy')->name('deleteCategory');
});
Route::controller(HealthCheckController::class)->group(function () {
    Route::get('/up', 'check');
});
Route::get('/health', [HealthCheckController::class, 'getHealthStatus']);
Route::post('/health', [HealthCheckController::class, 'getHealthStatus']);

Route::apiResource('posts', PostController::class);

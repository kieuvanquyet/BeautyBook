<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginApiMobileController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('services', ServiceController::class);
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/profile', [LoginApiMobileController::class, 'profile']);
// });

Route::post('/login', [LoginApiMobileController::class, 'login']);
Route::get('/logout', [LoginApiMobileController::class, 'logout']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('users', UserController::class);

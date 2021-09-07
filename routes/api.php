<?php

use App\Http\Controllers\REST\AuthController;
use App\Http\Controllers\REST\UsersController;
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

Route::post('/login', [
    AuthController::class, "login"
]);

Route::post('/register', [
    UsersController::class, "create"
]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [
        UsersController::class, "currentUser"
    ]);
});

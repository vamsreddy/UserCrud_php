<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::prefix('v2')->group(function () {
    Route::post('/create', [UserController::class, 'register'])->name('create');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/list', [UserController::class, 'index'])->name('index');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/show', [AuthController::class, 'show'])->name('show');
        Route::put('/update', [AuthController::class, 'update'])->name('update');
        Route::delete('/delete', [AuthController::class, 'delete'])->name('delete');
    });
});


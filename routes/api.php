<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');
    Route::post('registration', [AuthController::class, 'registration'])->name('api.auth.registration');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('api.auth.refresh');
    Route::post('me', [AuthController::class, 'me'])->name('api.auth.me');
});

Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.all');

    Route::prefix('auth')->group(function () {
        Route::post('/create', [NewsController::class, 'create'])->name('news.create');
        Route::put('/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::get('/{id}', [NewsController::class, 'show'])->name('news.show');
}); 
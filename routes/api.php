<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\Auth\LoginJWTController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);
});

Route::post('loginAdmin', [LoginJWTController::class, 'loginAdmin'])->name('loginAdmin');
Route::get('logoutAdmin', [LoginJWTController::class, 'logoutAdmin'])->name('logoutAdmin');
Route::get('refreshAdmin', [LoginJWTController::class, 'refreshAdmin'])->name('refreshAdmin');

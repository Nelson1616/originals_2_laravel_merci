<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
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

Route::resource('admins', AdminController::class);
Route::prefix('admins')->group(function () {
   
});

Route::resource('categories', CategoryController::class);
Route::prefix('categories')->group(function () {
   
});

Route::resource('authors', AuthorController::class);
Route::prefix('authors')->group(function () {
   
});

Route::resource('books', BookController::class);
Route::prefix('books')->group(function () {
   
});

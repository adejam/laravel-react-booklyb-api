<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->group(
    function () {
        // return $request->user();
        Route::get("get-user", [UserController::class, 'getUser']);
        Route::get("books/{book_id?}", [BookController::class, 'getBooks']);
        Route::post("add-book", [BookController::class, 'add']);
        Route::put("update-book", [BookController::class, 'update']);
        Route::delete("delete-book/{id}", [BookController::class, 'delete']);
        Route::get("logout", [UserController::class, 'logout']);
    }
);
Route::post("sign-up", [UserController::class, 'register']);
Route::post("login", [UserController::class, 'login']);

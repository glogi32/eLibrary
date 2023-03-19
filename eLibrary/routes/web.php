<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', function () {
    return view('pages.login');
});


Route::get("/home",[PagesController::class,"home"])->name("home");
Route::get("/",[PagesController::class,"home"])->name("home");

Route::middleware(['authMiddleware',"isLibrarian"])->group(function () {
    Route::get("/options/authors",[PagesController::class,"authors"])->name("authors");
    Route::get("/options/users",[PagesController::class,"users"])->name("users");

    Route::get("/authors",[AuthorController::class,"index"]);
    Route::post("/authors",[AuthorController::class,"store"])->name("addAuthor");
    Route::delete("/authors/{id}",[AuthorController::class,"destroy"])->name("deleteAuthor");

    Route::get("/users",[UserController::class,"index"]);
    Route::post("/users",[UserController::class,"store"])->name("addUser");
    Route::delete("/users/{id}",[UserController::class,"destroy"])->name("deleteUser");

    Route::post("/books",[BookController::class,"store"])->name("addBook");
    Route::delete("/books/{id}",[BookController::class,"destroy"])->name("deleteBook");
});



Route::get("/books",[BookController::class,"index"]);




Route::post("/login",[AuthController::class,"login"])->name("login");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");


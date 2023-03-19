<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PagesController;
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

Route::get("/options/authors",[PagesController::class,"authors"])->name("authors");
Route::get("/home",[PagesController::class,"home"])->name("home");
Route::get("/",[PagesController::class,"home"])->name("home");

Route::get("/authors",[AuthorController::class,"index"]);
Route::post("/authors",[AuthorController::class,"store"])->name("addAuthor");
Route::delete("/authors/{id}",[AuthorController::class,"destroy"])->name("deleteAuthor");

Route::get("/books",[BookController::class,"index"]);
Route::post("/books",[BookController::class,"store"])->name("addBook");
Route::delete("/books/{id}",[BookController::class,"destroy"])->name("deleteBook");

Route::post("/login",[AuthController::class,"login"])->name("login");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");


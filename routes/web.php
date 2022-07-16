<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//apply this middleware on this routes 
Route::middleware('isLogin')->group(function () {
    //Book:create
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');

    //Book:update
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/update/{id}', [BookController::class, 'update'])->name('books.update');

    //------------------------------categories----------------

    //Category:create
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

    //Category:update
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    //Note:create
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
});
Route::middleware('isLoginAdmin')->group(function (){

    //Book:delete
    Route::get('/books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');

    //Category:delete
    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

});
Route::middleware('isGuest')->group(function () {
    //----------------------Authentication-----------------------

    //register
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/handleR-register', [AuthController::class, 'handleRegister'])->name('auth.handleRegister');

    //login
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/handleR-login', [AuthController::class, 'handleLogin'])->name('auth.handleLogin');
});
//Book:read

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');



//-------------------------categories---------------------
//Category:read
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('login/github',[AuthController::class,'redirectToProvider'])->name('auth.github.redirect');
Route::get('login/github/callback',[AuthController::class,'handleProviderCallback'])->name('auth.github.callback');
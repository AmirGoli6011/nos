<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::resource('post', PostController::class)->middleware('auth')->except('show');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');


Route::resource('tag', TagController::class)->middleware('auth')->except('show');
Route::get('tag/{tag}', [TagController::class, 'show'])->name('tag.show');


Route::prefix('admin')->middleware('admin')->group(function () {
	Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
	Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
	Route::get('/comments', [AdminController::class, 'comments'])->name('admin.comments');
});

Route::prefix('favorite')->middleware('auth')->group(function () {
	Route::get('/', [FavoriteController::class, 'index'])->name('favorite.index');
	Route::post('/', [FavoriteController::class, 'store'])->name('favorite.store');
});

Route::prefix('comment')->middleware('auth')->group(function () {
	Route::post('/', [CommentController::class, 'store'])->name('comment.store');
	Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::prefix('user')->middleware('auth')->group(function () {
	Route::put('{username}', [UserController::class, 'update'])->name('user.update');
	Route::delete('{username}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/profile/{username}', [UserController::class, 'profile'])->name('profile');
Route::post('/follow', [UserController::class, 'follow'])->name('follow');

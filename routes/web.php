<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::resource('post', PostController::class)->middleware('auth');

Route::prefix('admin')->group(function () {
	Route::get('/users', [AdminController::class, 'users'])->name('admin.users')
		->middleware('admin');

	Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts')
		->middleware('admin');

	Route::get('/comments', [AdminController::class, 'comments'])->name('admin.comments')
		->middleware('admin');

	Route::get('/user/{user}', [AdminController::class, 'user'])->name('admin.user')
		->middleware('admin');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/comment', [PostController::class, 'comment_store'])->name('comment.store')
	->middleware('auth');

Route::delete('/comment/{comment}', [PostController::class, 'comment_destroy'])->name('comment.destroy');

Route::post('upload', [PostController::class, 'upload'])->name('post.upload');

Route::get('/tag/{tag}', [HomeController::class, 'tag'])->name('tag');

Route::get('/{slug}', [HomeController::class, 'post'])->name('post');
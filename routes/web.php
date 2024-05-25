<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Post\Create;
use App\Http\Livewire\Post\Edit;
use App\Http\Livewire\Post\Index;
use App\Http\Livewire\Post\Show;
use App\Http\Livewire\User\Dashboard;
use App\Http\Livewire\User\Profile;
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

//Route::resource('post', PostController::class)->middleware('auth')->except('show');
//Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');

Route::prefix('post')->middleware('auth')->group(function () {
	Route::get('/', Index::class)->name('post.index');
	Route::post('/', [PostController::class, 'store'])->name('post.store');
	Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
	Route::get('/create', Create::class)->name('post.create');
	Route::get('/{post}/edit', Edit::class)->name('post.edit');
});
Route::get('post/{post}', Show::class)->name('post.show');


Route::resource('tag', TagController::class)->middleware('admin')->except('show');

//Route::get('tag/{tag}', [TagController::class, 'show'])->name('tag.show');
Route::get('tag/{tag}', \App\Http\Livewire\Tag\Show::class)->name('tag.show');


Route::prefix('admin')->middleware('admin')->group(function () {
	Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
	Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
	Route::get('/comments', [AdminController::class, 'comments'])->name('admin.comments');
	Route::get('/user/@{username}', [AdminController::class, 'user'])->name('admin.user');
});

Route::prefix('comment')->middleware('auth')->group(function () {
	Route::post('/', [CommentController::class, 'store'])->name('comment.store');
	Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::prefix('user')->middleware('auth')->group(function () {
	Route::put('{username}', [UserController::class, 'update'])->name('user.update');
	Route::delete('{username}', [UserController::class, 'destroy'])->name('user.destroy');
});

//Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', Home::class)->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');
//Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');

//Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index')
//	->middleware('auth');
Route::get('/favorite', \App\Http\Livewire\Favorite\Index::class)->name('favorite.index')
	->middleware('auth');

Route::post('/follow', [UserController::class, 'follow'])->name('follow.web')
	->middleware('auth');

//Route::get('/@{username}', [UserController::class, 'profile'])->name('profile');
Route::get('/@{username}', Profile::class)->name('profile');

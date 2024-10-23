<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Post\Create;
use App\Http\Livewire\Post\Edit;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Voyager;

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

Route::resource('category', CategoryController::class)->middleware('admin')->except('show');

Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::prefix('user')->middleware('auth')->group(function () {
	Route::put('{username}', [UserController::class, 'update'])->name('user.update');
	Route::delete('{username}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index')->middleware('auth');

Route::get('/@{user}', [UserController::class, 'profile'])->name('profile');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

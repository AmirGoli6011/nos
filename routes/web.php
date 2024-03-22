<?php

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

Route::resource('comment', CommentController::class)->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/tag/{tag}', [HomeController::class, 'tag'])->name('tag');

Route::post('upload', [PostController::class, 'upload'])->name('post.upload');

Route::get('/{slug}', [HomeController::class, 'post'])->name('post');
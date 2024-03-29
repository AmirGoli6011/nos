<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/upload',[PostController::class,'upload'])->name('post.upload');

Route::post('/move',[PostController::class,'move'])->name('post.move');

Route::post('/title',[PostController::class,'title'])->name('post.title');

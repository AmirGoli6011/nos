<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class FavoriteController extends Controller
{
	public function index()
	{
		$posts = auth()->user()->getFavoriteItems(Post::class)->orderBy('id','desc')->get();
		return view('favorite.index',compact('posts'));
	}

	public function store(Request $request)
	{
		$user = User::find($request->user);
		$post = Post::find($request->post);
		$user->toggleFavorite($post);
		return back();
	}
}

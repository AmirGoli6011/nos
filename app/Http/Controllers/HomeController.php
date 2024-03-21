<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')->get();
		return view('home', compact('posts'));
	}

	public function post($post)
	{
		$user = Post::find($post->id)->user;
		return view('post', compact(['post', 'user']));
	}

	public function search($search)
	{
		$posts = Post::where('title', $search)->get();

		dd($posts);
		return view('home', compact('posts'));
	}
}

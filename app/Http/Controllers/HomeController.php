<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\QueryString;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')->get();
		return view('home', compact('posts'));
	}

	public function post($slug)
	{
		$post = Post::where('slug', $slug)->firstOrfail();
		$user = $post->user;
		$comments = $post->comments;
		return view('post', compact(['post', 'user', 'comments']));
	}

	public function search(Request $request)
	{
		$search = $request->all('search');
		$posts = Post::where('title','regexp', $search)
			->orWhere('slug','regexp',$search)
			->orWhere('body','regexp',$search)
			->get();
		return view('home', compact('posts'));
	}
}

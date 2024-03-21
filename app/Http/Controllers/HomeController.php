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

	public function post($slug)
	{
		$post = Post::where('slug',$slug)->firstOrfail();
		$user = $post->user;
		$comments = $post->comments;
		return view('post', compact(['post', 'user','comments']));
	}

	public function search($search)
	{
		dd($search);
		$posts = Post::where('title', $search)->get();

		dd($posts);
		return view('home', compact('posts'));
	}
}

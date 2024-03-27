<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use http\QueryString;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')->get();
		return view('home', compact('posts'));
	}

	public function search(Request $request)
	{
		$search = $request->all('search');
		$posts = Post::where('title', 'regexp', $search)
			->orWhere('slug', 'regexp', $search)
			->orWhere('body', 'regexp', $search)
			->get();
		return view('home', compact('posts'));
	}
}

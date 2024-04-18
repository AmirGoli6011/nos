<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Post::orderByDesc('id')->paginate(20);
		return view('home', compact('posts'));
	}

	public function search(Request $request)
	{
		$search = $request->all('search');
		$posts = Post::where('title', 'regexp', $search)
			->orWhere('slug', 'regexp', $search)
			->orWhere('body', 'regexp', $search)
			->paginate(20);
		return view('home', compact('posts'));
	}
}

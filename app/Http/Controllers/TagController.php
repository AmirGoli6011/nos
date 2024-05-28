<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	public function index()
	{
		$tags = Tag::orderBy('id', 'desc')->get();
		return view('admin.tags', compact('tags'));
	}

	public function create()
	{
		return view('tag.create');
	}

	public function show(Tag $tag)
	{
		$posts = $tag->posts()->paginate(20);
		return view('home', compact('posts'));
	}

	public function edit(Tag $tag)
	{
		return view('tag.edit', compact('tag'));
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = auth()->user();
		$posts = $user->posts;
		return view('post.index', compact('posts'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Post $post
	 * @return Response
	 */
	public function show(Post $post)
	{
		$user = $post->user;
		$comments = $post->comments;
		return view('post.show', compact(['post', 'user', 'comments']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Post $post
	 * @return Response
	 */
	public function edit(Post $post)
	{
		return view('post.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Post $post
	 * @return Response
	 */
	public function update(Request $request, Post $post)
	{
		$data = $request->validate([
			'title' => 'required|max:20|unique:App\Models\Post,title,' . $post->id,
			'body' => 'required',
			'image' => 'image|mimes:jpg,png,jpeg|max:2048',
			'tags' => 'nullable',
		]);

		$imagePath = $post->image;

		if (isset($data['image'])) {
			if ($post->image) {
				unlink(public_path($post->image));
			}
			$image = $data['image'];
			$imagePath = $image->store('images/' . $post->dir);
		}

		$post->update([
			'title' => $data['title'],
			'body' => $data['body'],
			'image' => $imagePath,
		]);

		if (isset($data['tags'])) {
			$post->tags()->sync($data['tags']);
		}

		return redirect(route('post.index'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'title' => 'required|max:20|unique:App\Models\Post',
			'body' => 'required',
			'image' => 'image|nullable|mimes:jpg,png,jpeg',
			'tags' => 'nullable',
		]);

		$imagePath = null;


		if (isset($data['image'])) {
			$image = $data['image'];
			$imagePath = $image->store('images/' . strval(Post::orderByDesc('id')->first()->dir + 1));
		}

		$postData = [
			'title' => $data['title'],
			'body' => $data['body'],
			'dir' => strval(Post::orderByDesc('id')->first()->dir + 1),
			'image' => $imagePath,
		];

		$post = auth()->user()->posts()->create($postData);

		if (isset($data['tags'])) {
			$post->tags()->attach($data['tags']);
		}

		return redirect(route('post.index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('post.create');
	}

	public function uploadCreate()
	{
		$id = strval(Post::orderByDesc('id')->first()->dir + 1);

		reset($_FILES);
		$image = current($_FILES);

		if (!is_dir(public_path('images/' . $id))) {
			mkdir(public_path('images/' . $id));
		}

		$path = 'images/' . $id . '/' . $image['name'];

		move_uploaded_file($image['tmp_name'], $path);

		return response()->json(['location' => asset($path)]);
	}


	public function uploadUpdate(Post $id)
	{
		$id = $id->dir;

		reset($_FILES);
		$image = current($_FILES);

		if (!is_dir(public_path('images/' . $id))) {
			mkdir(public_path('images/' . $id));
		}

		$path = 'images/' . $id . '/' . $image['name'];

		move_uploaded_file($image['tmp_name'], $path);

		return response()->json(['location' => asset($path)]);
	}
}

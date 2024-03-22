<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = auth()->user();
		$posts = $user->posts;
		return view('post.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('post.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostRequest $request)
	{
		if (file_exists($request->file('image')) and array_key_exists('tags', $request->all())) {
			$image = $request->file('image');
			$image = $image->store('images');
			$post = auth()->user()->posts()->create([
				'image' => $image,
				'title' => $request->title,
				'body' => $request->body,
			]);
			$post->tags()->attach($request->tags);
		} elseif (file_exists($request->file('image'))) {
			$image = $request->file('image');
			$image = $image->store('images');
			auth()->user()->posts()->create([
				'image' => $image,
				'title' => $request->title,
				'body' => $request->body,
			]);
		} elseif (array_key_exists('tags', $request->all())) {
			$post = auth()->user()->posts()->create([
				'title' => $request->title,
				'body' => $request->body,
			]);
			$post->tags()->attach($request->tags);
		} else {
			auth()->user()->posts()->create([
				'title' => $request->title,
				'body' => $request->body,
			]);
		}
		return redirect(route('post.index'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		return view('post.edit', compact('post', compact('post')));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostRequest $request, Post $post)
	{
		if (file_exists($request->file('image')) and array_key_exists('tags', $request->all())) {
			$image = $request->file('image');
			$image = $image->store('images');
			$post->update([
				'image' => $image,
				'title' => $request->title,
				'body' => $request->body,
			]);
			$post->tags()->sync($request->tags);
		} elseif (file_exists($request->file('image'))) {
			$image = $request->file('image');
			$image = $image->store('images');
			$post->update([
				'image' => $image,
				'title' => $request->title,
				'body' => $request->body,
			]);
		} elseif (array_key_exists('tags', $request->all())) {
			$post->update([
				'title' => $request->title,
				'body' => $request->body,
			]);
			$post->tags()->sync($request->input('tags'));
		} else {
			$post->update([
				'title' => $request->title,
				'body' => $request->body,
			]);
		}
		return redirect(route('post.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect(route('post.index'));
	}

	public function upload(Request $request)
	{
		$image = $request->file('upload');
		$image = $image->store('images');
		return response()->json(['fileName' => $image, 'uploaded' => 1, 'url' => asset('storage/' . $image)]);
	}
}

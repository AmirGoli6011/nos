<?php

namespace App\Http\Controllers;

use App\Models\Post;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Events\queueable;

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
	public function store(Request $request)
	{
		$request = $request->validate([
			'title' => 'required|max:20|unique:App\Models\Post',
			'body' => 'required',
			'image' => 'image|mimes:jpg,png,jpeg',
		]);
		if (array_key_exists('image', $request) and array_key_exists('tags', $request)) {
			$image = $request['image'];
			$image = $image->store($request['title']);
			$image = 'storage/' . $image;
			$post = auth()->user()->posts()->create([
				'image' => $image,
				'title' => $request['title'],
				'body' => $request['body'],
			]);
			$post->tags()->attach($request['tags']);
		} elseif (array_key_exists('image', $request)) {
			$image = $request['image'];
			$image = $image->store($request['title']);
			$image = 'storage/' . $image;
			auth()->user()->posts()->create([
				'image' => $image,
				'title' => $request['title'],
				'body' => $request['body'],
			]);
		} elseif (array_key_exists('tags', $request)) {
			$post = auth()->user()->posts()->create([
				'title' => $request['title'],
				'body' => $request['body'],
			]);
			$post->tags()->attach($request['tags']);
		} else {
			auth()->user()->posts()->create([
				'title' => $request['title'],
				'body' => $request['body'],
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
		$user = $post->user;
		$comments = $post->comments;
		return view('post.show', compact(['post', 'user', 'comments']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		return view('post.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Post $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
		$request = $request->validate([
			'title' => 'required|max:20',
			'body' => 'required',
			'image' => 'image|mimes:jpg,png,jpeg|max:2048',
		]);
		if (array_key_exists('image', $request) and array_key_exists('tags', $request)) {
			$file = Storage::path($post->image);
			unlink($file);
			$image = $request['image'];
			$image = $image->store($request['title']);
			$image = 'storage/' . $image;
			$post->update([
				'image' => $image,
				'title' => $request['title'],
				'body' => $request['body'],
			]);
			$post->tags()->sync($request['tags']);
		} elseif (array_key_exists('image', $request)) {
			$file = Storage::path($post->image);
			unlink($file);
			$image = $request['image'];
			$image = $image->store($request['title']);
			$image = 'storage/' . $image;
			$post->update([
				'image' => $image,
				'title' => $request['title'],
				'body' => $request['body'],
			]);
		} elseif (array_key_exists('tags', $request)) {
			$post->update([
				'title' => $request['title'],
				'body' => $request['body'],
			]);
			$post->tags()->sync($request['tags']);
		} else {
			$post->update([
				'title' => $request['title'],
				'body' => $request['body'],
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
		$path = Storage::path($post->title);
		if (is_dir($path)) {
			$files = glob($path . '/*');
			foreach ($files as $file) {
				unlink($file);
			}
			rmdir($path);
		}
		$post->delete();
		return back();
	}

	public function upload(Request $request)
	{
		if (array_key_exists('title', $request)) {
			$title = $request->title;
		} else {
			session_start();
			$title = $_SESSION['title'];
		}
		$image = $request->file('upload');
		$image = $image->store($title);
		return response()->json(['fileName' => $image, 'uploaded' => 1, 'url' => asset('storage/' . $image)]);
	}

	public function title(Request $request)
	{
		session_start();
		$title = $request->title;
		$_SESSION['title'] = $title;
	}
}

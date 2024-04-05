<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
		if (array_key_exists('image', $data) and array_key_exists('tags', $data)) {
			unlink(public_path($post->image));
			$image = $data['image'];
			$image = $image->move($data['title'], $image->getATime() . '.' . $image->extension());
			$image = $image->getPathname();
			$post->update([
				'image' => $image,
				'title' => $data['title'],
				'body' => $data['body'],
			]);
			$post->tags()->sync($data['tags']);
		} elseif (array_key_exists('image', $data)) {
			unlink(public_path($post->image));
			$image = $data['image'];
			$image = $image->move($data['title'], $image->getATime() . '.' . $image->extension());
			$image = $image->getPathname();
			$post->update([
				'image' => $image,
				'title' => $data['title'],
				'body' => $data['body'],
			]);
		} elseif (array_key_exists('tags', $data)) {
			$post->update([
				'title' => $data['title'],
				'body' => $data['body'],
			]);
			$post->tags()->sync($data['tags']);
		} else {
			$post->update([
				'title' => $data['title'],
				'body' => $data['body'],
			]);
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
			'image' => 'image|mimes:jpg,png,jpeg',
			'tags' => 'nullable',
		]);
		if (array_key_exists('image', $data) and array_key_exists('tags', $data)) {
			$image = $data['image'];
			$image = $image->move($data['title'], $image->getATime() . '.' . $image->extension());
			$image = $image->getPathname();
			$post = auth()->user()->posts()->create([
				'image' => $image,
				'title' => $data['title'],
				'body' => $data['body'],
			]);
			$post->tags()->attach($data['tags']);
		} elseif (array_key_exists('image', $data)) {
			$image = $data['image'];
			$image = $image->move($data['title'], $image->getATime() . '.' . $image->extension());
			$image = $image->getPathname();
			auth()->user()->posts()->create([
				'image' => $image,
				'title' => $data['title'],
				'body' => $data['body'],
			]);
		} elseif (array_key_exists('tags', $data)) {
			$post = auth()->user()->posts()->create([
				'title' => $data['title'],
				'body' => $data['body'],
			]);
			$post->tags()->attach($data['tags']);
		} else {
			auth()->user()->posts()->create([
				'title' => $data['title'],
				'body' => $data['body'],
			]);
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Post $post
	 * @return Response
	 */
	public function destroy(Post $post)
	{
		$path = public_path($post->title);
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
		session_start();
		if (array_key_exists('title', $request->all())) {
			$title = $request->title;
		} elseif (array_key_exists('title', $_SESSION)) {
			$title = $_SESSION['title'];
		} else {
			return '';
		}
		$image = $request->file('upload');
		$image = $image->move($title, $image->getATime() . '.' . $image->extension());
		session_destroy();
		return response()->json(['fileName' => $image->getFilename(), 'uploaded' => 1,
			'url' => asset($image->getPathname())]);
	}

	public function title(Request $request)
	{
		session_start();
		$title = $request->title;
		$_SESSION['title'] = $title;
	}
}

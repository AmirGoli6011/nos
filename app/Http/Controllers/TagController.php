<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$tags = Tag::orderBy('id', 'desc')->get();
		return view('admin.tags', compact('tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|unique:App\Models\Tag'
		]);
		Tag::create([
			'name' => $data['name']
		]);
		return redirect(route('tag.index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('tag.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tag $tag)
	{
		$posts = $tag->posts()->paginate(20);
		return view('home', compact('posts'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Tag $tag)
	{
		return view('tag.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Tag $tag)
	{
		$data = $request->validate([
			'name' => 'required'
		]);
		$tag->update([
			'name' => $data['name']
		]);
		return redirect(route('tag.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Tag $tag)
	{
		$tag->delete();
		return redirect(route('tag.index'));
	}
}

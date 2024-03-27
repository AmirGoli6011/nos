<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

	public function store(Request $request)
	{
		$comment = $request->validate([
			'post_id' => 'required',
			'comment' => 'required',
		]);
		auth()->user()->comments()->create([
			'post_id' => $comment['post_id'],
			'comment' => $comment['comment'],
		]);
		return back();
	}

	public function destroy(Comment $comment)
	{
		$comment->delete();
		return back();
	}
}

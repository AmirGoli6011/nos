<?php

namespace App\Http\Livewire\Post;

use App\Models\Comment;
use Livewire\Component;

class Show extends Component
{
	public $user;
	public $post;
	public $comments;
	public $comment;

	public function mount($post)
	{
		$this->post = $post;
		$this->user = $post->user;
		$this->comments = $post->comments;
	}

	public function comment()
	{
		auth()->user()->comments()->create([
			'user_id' => auth()->id(),
			'post_id' => $this->post->id,
			'comment' => $this->comment,
		]);
		$this->comment = '';
		$this->comments = $this->post->comments()->get();
	}

	public function delete(Comment $comment)
	{
		$comment->delete();
		$this->comments = $this->post->comments()->get();
	}

	public function render()
	{
		return view('livewire.post.show');
	}
}

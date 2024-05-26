<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
	public $post;
	public $user;
	public $comments;
	public $comment;

	public function mount(Post $post)
	{
		$this->post = $post;
		$this->user = $post->user;
		$this->comments = $post->comments;
	}

	public function comment()
	{
		auth()->user()->comments()->create([
			'post_id' => $this->post->id,
			'comment' => $this->comment,
		]);
		$this->comments = $this->post->comments;
	}

	public function render()
	{
		return view('livewire.post.show');
	}
}

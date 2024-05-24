<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
	public $posts;

	public function mount()
	{
		$this->posts = Post::orderByDesc('id')->get();
	}

	public function like($userId, $postId)
	{
		$user = User::find($userId);
		$post = Post::find($postId);
		$user->toggleFavorite($post);
	}

	public function render()
	{
		return view('livewire.home');
	}
}

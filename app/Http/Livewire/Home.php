<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
	public $perPage = 6;
	protected $listeners = ['loadMore'];

	public function loadMore()
	{
		$this->perPage = $this->perPage + 6;
	}

	public function like(Post $post)
	{
		auth()->user()->toggleFavorite($post);
	}

	public function follow(User $user)
	{
		auth()->user()->toggleFollow($user);
	}

	public function render()
	{
		$posts = Post::orderByDesc('id')->paginate($this->perPage);
		return view('livewire.home', compact('posts'));
	}
}

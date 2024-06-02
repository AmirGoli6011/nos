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

	public function like($userId, $postId)
	{
		$user = User::find($userId);
		$post = Post::find($postId);
		$user->toggleFavorite($post);
	}

	public function follow($follower, $followable)
	{
		$follower = User::find($follower);
		$followable = User::find($followable);
		$follower->toggleFollow($followable);
	}

	public function render()
	{
		$posts = Post::orderByDesc('id')->paginate($this->perPage);
		return view('livewire.home', compact('posts'));
	}
}

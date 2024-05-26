<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
	use WithPagination;

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
		$posts = Post::paginate(10);
		return view('livewire.home',compact('posts'));
	}
}

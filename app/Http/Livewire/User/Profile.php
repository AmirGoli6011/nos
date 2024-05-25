<?php

namespace App\Http\Livewire\User;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
	public $user;

	public function mount()
	{
		$this->user = auth()->user();
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
		return view('livewire.user.profile');
	}
}

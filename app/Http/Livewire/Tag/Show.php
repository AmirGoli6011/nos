<?php

namespace App\Http\Livewire\Tag;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
	public $posts;

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
		return view('livewire.category.show');
	}
}

<?php

namespace App\Http\Livewire\Favorite;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
	public $posts;

	public function mount()
	{
		$this->posts = auth()->user()->getFavoriteItems(Post::class)->orderBy('id','desc')->get();
	}

	public function like(Post $post)
	{
		auth()->user()->unfavorite($post);
		$this->posts = auth()->user()->getFavoriteItems(Post::class)->orderBy('id','desc')->get();
	}

    public function render()
    {
        return view('livewire.favorite.index');
    }
}

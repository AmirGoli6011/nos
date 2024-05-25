<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Sidebar extends Component
{
	public $posts;
	public $search;

	public function search($search)
	{
		$this->posts = Post::where('title', 'regexp', $search)
			->orWhere('slug', 'regexp', $search)
			->orWhere('body', 'regexp', $search)
			->paginate(20);
	}

	public function render()
	{
		return view('livewire.sidebar');
	}
}

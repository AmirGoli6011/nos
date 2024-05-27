<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Sidebar extends Component
{
	public $search;
	public $posts;

	public function updated()
	{
		$this->posts = Post::where('title', 'regexp', $this->search)
			->orWhere('slug', 'regexp', $this->search)
//			->orWhere('body', 'regexp', $this->search)
			->get();
	}

	public function render()
	{
		return view('livewire.sidebar');
	}
}

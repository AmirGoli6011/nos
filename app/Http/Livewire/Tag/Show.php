<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;

class Show extends Component
{
	public $posts;

	public function mount(Tag $tag)
	{
		$this->posts = $tag->posts()->get();
	}
    public function render()
    {
        return view('livewire.home');
    }
}

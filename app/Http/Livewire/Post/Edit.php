<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
	use WithFileUploads;

	public $post;

	public function mount($post)
	{
		$this->post = $post;
	}

	public function render()
	{
		return view('livewire.post.edit');
	}
}

<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	public $posts;
	public $user;
	public $post;

	public function mount()
	{
		$this->user = auth()->user();
		$this->posts = $this->user->posts()->get();
	}

	public function delete(Post $post)
	{
		$path = public_path('images/' . $post->dir);

		if (is_dir($path)) {
			$files = glob($path . '/*');
			foreach ($files as $file) {
				unlink($file);
			}
			rmdir($path);
		}

		$post->delete();

		$this->user = auth()->user();
		$this->posts = $this->user->posts;
	}

	public function render()
	{
		return view('livewire.post.index');
	}
}

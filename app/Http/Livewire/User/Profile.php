<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
	public $user;
	public $followers;
	public $followings;

	public function mount()
	{
		$this->followers = $this->user->followers;
		$this->followings = $this->user->followings;
	}

	public function follow(User $user)
	{
		auth()->user()->toggleFollow($user);
		$this->followers = $this->user->followers;
		$this->followings = $this->user->followings;
	}

	public function render()
	{
		return view('livewire.user.profile');
	}
}

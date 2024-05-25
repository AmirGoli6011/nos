<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
	public $user;

	public function mount($user)
	{
		$this->user = $user;
	}

	public function follow(User $follower, User $followable)
	{
		$follower->toggleFollow($followable);
		$this->user = $followable;
	}

	public function render()
	{
		return view('livewire.user.profile');
	}
}

<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
	use WithFileUploads;

	public $avatar;
	public $name;
	public $username;
	public $email;
	public $password;
	public $password_confirmation;
	public $alert = '';

	public function mount()
	{
		$user = auth()->user();
		$this->name = $user->name;
		$this->username = $user->username;
		$this->email = $user->email;
	}

	public function updated()
	{
		$this->validate([
			'name' => 'required|string|max:255',
			'username' => 'required|string|alpha_dash|max:255|unique:users,username,' . auth()->id(),
			'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
			'password' => 'string|min:8|confirmed',
		]);
	}

	public function update()
	{
		if ($this->avatar !== null) {
			$avatar = $this->avatar->storeAs('avatars', $this->username . '.' . $this->avatar->extension());
			auth()->user()->update([
				'avatar' => $avatar,
				'name' => $this->name,
				'username' => $this->username,
				'email' => $this->email,
				'password' => Hash::make($this->password),
			]);
			$this->password = $this->password_confirmation = $this->avatar = null;
			$this->alert = '<script>alert("اطلاعات شما ذخیره شد")</script>';
		}
		auth()->user()->update([
			'name' => $this->name,
			'username' => $this->username,
			'email' => $this->email,
			'password' => Hash::make($this->password),
		]);
		$this->password = $this->password_confirmation = $this->avatar = null;
		$this->alert = '<script>alert("اطلاعات شما ذخیره شد")</script>';
	}

	public function render()
	{
		return view('livewire.user.dashboard');
	}
}

<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
	public $name;
	public $username;
	public $email;
	public $password;
	public $password_confirmation;

	public function updated()
	{
		$this->validate([
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string','alpha_dash', 'max:255', 'unique:users,username'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}

    public function render()
    {
        return view('livewire.auth.register');
    }
}

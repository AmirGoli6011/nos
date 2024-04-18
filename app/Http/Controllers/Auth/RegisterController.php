<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'max:255', 'unique:users,username'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'avatar' => ['image', 'mimes:jpg,png,jpeg', 'max:2048'],
			'g-recaptcha-response' => 'required|captcha'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return \App\Models\User
	 */
	protected function create(array $data)
	{
		if (array_key_exists('avatar', $data)) {
			$avatar = $data['avatar'];
			$avatar = $avatar->move('avatars',$avatar->getATime().'.'.$avatar->extension());
			$avatar = $avatar->getPathname();
			return User::create([
				'avatar' => $avatar,
				'name' => $data['name'],
				'username' => $data['username'],
				'email' => $data['email'],
				'password' => Hash::make($data['password']),
			]);
		}
		return User::create([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function profile($user)
	{
		return view('user.profile', compact('user'));
	}

	public function dashboard()
	{
		return view('user.dashboard');
	}

	public function follow(Request $request)
	{
		$follower = User::findOrfail($request->follower);
		$followable = User::findOrfail($request->followable);
		$follower->toggleFollow($followable);
		return back();
	}

	public function update(Request $request, User $user)
	{
		$data = $request->validate([
			'name' => ['required', 'string'],
			'username' => ['required', 'string', 'alpha_dash', 'unique:users,username,' . $user->id],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
			'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
		]);
		if (array_key_exists('avatar', $data)) {
			$avatar = $data['avatar'];
			$avatar = $avatar->store('avatars');
			$avatar = 'storage/' . $avatar;
			$user->update([
				'avatar' => $avatar,
				'name' => $data['name'],
				'username' => $data['username'],
				'email' => $data['email'],
				'password' => Hash::make($data['password']),
			]);
		}
		$user->update([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);
		return back();
	}

	public function destroy(User $user)
	{
		$user->delete();
		return back();
	}
}

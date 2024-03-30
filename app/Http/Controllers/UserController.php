<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}

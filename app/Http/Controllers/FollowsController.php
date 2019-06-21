<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
	public function __construct() {
		// make those methods access to login required
		$this->middleware('auth');
	}

	public function create(\App\User $user) {
		return auth()->user()->following()->toggle($user->profile);
	}
}

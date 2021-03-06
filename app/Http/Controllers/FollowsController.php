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
		if(auth()->user()->id != $user->id) {
			return auth()->user()->following()->toggle($user->profile);	
		}		
		else {
			return false;
		}		
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	public function index() {
		$users = \App\User::paginate(5);

		return view('users.index', compact('users'));
	}
}

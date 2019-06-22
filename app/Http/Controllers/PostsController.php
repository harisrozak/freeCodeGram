<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; // an external library for image resizing

class PostsController extends Controller
{
	public function __construct() {
		// make those methods access to login required
		// $this->middleware('auth');
	}

	public function index() {
		if(auth()->user()) {
			$users = auth()->user()->following->pluck('user_id');

			// show following's posts if he has following someone
			// otherwise show all user profiles so they can do some follow 
			if($users->all()) {
				$posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
				return view('posts.index', compact('posts'));
			}
		}

		// redirect to index profiles if its can't access the index posts
		return redirect(route('profiles.index'));
	}

	public function create() {
		// must logged in
		if(! auth()->user()) {
			return redirect(route('login'));
		}

		// load the /resources/views/posts/create.blade.php
		return view('posts.create');
	}

	public function store() {
		// must logged in
		if(! auth()->user()) {
			return redirect(route('login'));
		}

		// validate the post data
		$data = request()->validate(array(
			'caption' => 'required',
			'image' => array('required', 'image'),
		));

		// store the image file to the /storage/app/public/uploads folder
		$imagePath = request('image')->store('uploads', 'public');

		// resize the image with Intervention\Image\Facades\Image
		$imageResizer = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
		$imageResizer->save();

		// insert post to the related user
		auth()->user()->posts()->create(array(
			'caption' => $data['caption'],
			'image' => $imagePath,
		));

		// redirect to current user profile page
		return redirect(route('profiles.show', auth()->user()->username));
	}

	public function show(\App\Post $post) {
		return view('posts.show', compact('post'));
	}
}

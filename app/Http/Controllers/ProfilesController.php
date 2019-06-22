<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image; // an external library for image resizing

class ProfilesController extends Controller
{
    public function index() {
        $users = User::paginate(5);

        return view('profiles.index', compact('users'));
    }

    public function show(User $user) {
        // must be logged in to get the following
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        // return to index profiles view
        return view('profiles.show', compact('user', 'follows'));
    }

    public function edit(User $user) {
    	// authorize with ProfilePolicy
    	$this->authorize('update', $user->profile);

    	// return to edit view
    	return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
    	// authorize with ProfilePolicy
    	$this->authorize('update', $user->profile);

    	// validate the post data
    	$data = request()->validate(array(
    		'title' => 'required',
    		'description' => 'required',
    		'url' => 'url',
    		'image' => '',
    	));

    	// the user is update the image or not
    	if(request('image')) {
	    	// store the image file to /storage/app/public/upload folder
	    	$imagePath = request('image')->store('profile', 'public');

	    	// resize the image with Intervention\Image\Facades\Image
	    	$imageResizer = Image::make("storage/{$imagePath}")->fit(1000, 1000);
	    	$imageResizer->save();
	    }
	    else {
	    	$imagePath = $user->profile->image;
	    }

	    // save data to the current user profile
	    auth()->user()->profile()->update(array_merge(
	    	$data, array(
	    		'image' => $imagePath,
	    	)
	    ));

    	return redirect(route('profiles.show', auth()->user()->username));
    }
}

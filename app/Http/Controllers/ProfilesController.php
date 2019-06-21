<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image; // an external library for image resizing

class ProfilesController extends Controller
{
    public function index(User $user) {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // caching count.profile.args
        $counts = Cache::remember(
            'count.profile.args.' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return array(
                    'posts' => $user->posts->count(),
                    'followers' => $user->profile->followers->count(),
                    'following' => $user->following->count(),
                );
            }
        );

        return view('profiles.index', compact('user', 'follows', 'counts'));
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
	    	$imageResizer = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
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

    	return redirect(route('profiles.show', auth()->user()->id));
    }
}

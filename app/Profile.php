<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	public $guarded = array();

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function profileImage() {
    	$imagePath = $this->image ? $this->image : 'profile/blank-profile-picture.png';
    	return '/storage/' . $imagePath;
    }

    public function followers() {
    	return $this->belongsToMany(User::class);
    }
}

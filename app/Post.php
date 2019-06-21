<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $guarded = array();

    public function user() {
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();
        
        // visit here for the documentation: https://laravel.com/docs/5.8/eloquent#events 
        static::created(function($user){
            $user->profile()->create(array(
                'title' => $user->username
            ));

            // send a welcome email to the new registered user
            Mail::to($user->email)->send(new \App\Mail\NewUserWelcomeMail());
        });
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following() {
        return $this->belongsToMany(Profile::class);
    }

    public function count($type = 'posts') {
        $user = $this;

        // caching the counter
        return Cache::remember(
            sprintf("count.user.%s.%s", $type, $user->id),
            now()->addSeconds(60),
            function() use($user, $type) {
                switch ($type) {
                    case 'posts':
                        return $user->posts->count();
                        break;

                    case 'followers':
                        return $user->profile->followers->count();
                        break;

                    case 'following':
                        return $user->following->count();
                        break;
                    
                    default:
                        return false;
                        break;
                }
            }
        );
    }
}

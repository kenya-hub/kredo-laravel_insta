<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // User has many posts
    // To get all the posts of a user
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }


    # One to Many
    # User has many followers
    # To get all the followers of a user but only IDs
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }


    # One to Many
    # User has many following
    # To get all the following users but only IDs
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    #Will return TURE is the Auth user is following a user.
    public function isFollowed()
    {
        return $this->followers()->where('follower_id' , Auth::user()->id)->exists();
    }
}

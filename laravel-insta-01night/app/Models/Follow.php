<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $timestamps = false;

    # To get the info of a follower like name, email etc....
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }


    # One to Many (inverse)
    # To get the info of the following user
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}

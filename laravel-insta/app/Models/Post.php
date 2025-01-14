<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    # post belogns to a user
    # To get the owner of the post
    public function user(){
        return $this->belongsTo(User::class);
    }

    # To get all the categories of the post but only IDs
    public function categoryPost(){
        return $this->hasmany(CategoryPost::class);
    }

    # Post has many commnets
    # To get all the comments of the post
    public function comments(){
        return $this->hasmany(Comment::class);
    }

}

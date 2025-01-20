<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    # post belongs to a user
    # To get the owner of the post
    public function user(){
        return $this->belongsTo(User::class);
    }


    # To get all the categories of a post but only IDs
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }


    # to get the name of the category_id
    public function category(){
        return $this->belongsTo(Category::class);
    }


    # Post has many comments
    # To get all the comments of a post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    # Post has many likes
    # To get all the likes of a post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    # Returns TRUE if the Auth user already liked the post
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    # Comment belongs to a post
    # To get the owner/user info of the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

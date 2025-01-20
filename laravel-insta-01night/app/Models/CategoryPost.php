<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_post'; // this model shoud be connected to this table name 'category_post'
    protected $fillable = ['category_id', 'post_id'];
    public $timestamps = false; // make the model aware that we do not need/want to use the timestamps


    # to get the name of the category_id
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCarPost extends Model
{
    protected $table = "comments_car_posts";
    protected $fillable = ["user_id","car_post_id","content"];  
}

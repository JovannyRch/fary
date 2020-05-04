<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        'piece', 'model', 'brand', 'isnational','img','details','user_id'
    ]; 
}

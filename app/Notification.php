<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    protected $fillable = [
        'user_id', 'post_id', 'comment_id','to_user_id','type','visto'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function post()
    {
        return $this->hasOne('App\Post','id','post_id');
    }

    public function comment()
    {
        return $this->hasOne('App\Comment','id','comment_id');
    }
}

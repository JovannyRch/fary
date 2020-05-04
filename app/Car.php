<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = "cars";
    protected $fillable= ['id','content','user_id'];

    public function imgs()
    {
        return $this->hasMany('App\ImgsCar');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

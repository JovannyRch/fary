<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgsCar extends Model
{
    protected $table = "imgs_cars";
    protected $fillable = ["id","url","car_id"];
}

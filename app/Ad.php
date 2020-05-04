<?php
namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = "ads";
    protected $fillable = ["negocio_id",'url','tiempo'];

    public function negocio()
    {
        return $this->hasOne('App\Negocio','id','negocio_id');
    }

    public function isVideo(){
        return Str::endsWith($this->url, ['mp4']);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = "negocios";
    protected $fillable = [
        'name', 'email', 'phone','address',"img",'owner_id','longitud','latitud'
    ];

    public function tipos()
    {
        return $this->belongsToMany('App\Tipo', 'tipos_negocios', 'negocio_id', 'tipo_id');
    }

    public function tipos_id(){
        $res = [];
        foreach ($this->tipos as $tipo) {
            $res[] = $tipo->id;
        }
        return $res;
    }
}

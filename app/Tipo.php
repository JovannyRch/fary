<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = "tipos";
    protected $fillable = [
        'name'
    ]; 

    public function negocios()
    {
        return $this->belongsToMany('App\Negocio', 'tipos_negocios', 'tipo_id', 'negocio_id');
     
    }
}

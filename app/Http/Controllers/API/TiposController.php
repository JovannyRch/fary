<?php

namespace App\Http\Controllers\API;

use App\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiposController extends Controller
{
    public function index(){
        $data = Tipo::select('id','name')->get();
        $msg = "Ok";
        return response()->json( compact("data","msg"), 200);
    }

    public function negocios($id){
        $tipo = Tipo::find($id);
        $negocios = $tipo->negocios;
        /*
        $tipo = Tipo::find($id);
        $negocios = DB::statement("SELECT * FROM negocios where id in 
        (SELECT negocio_id FROM tipos_negocios where tipo_id = )
        ");
        */

        $data['tipo'] = $tipo;
        $data['negocios'] = $negocios;

        $msg = "Ok";
        return response()->json(compact("data","msg"), 200);
    }
    
}

<?php

namespace App\Http\Controllers\API;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    public function index($latitud = null, $longitud = null){
    
        if($latitud == null && $longitud == null){
            $data = Ad::select('url','tiempo')->get();
            $msg = "Ok";
        }else {
            $location = $this->queryLocation($latitud,$longitud);
            $data = Ad::select('url','tiempo')
            ->join('negocios', 'negocios.id', '=', 'ads.negocio_id')
            ->select('ads.url','ads.tiempo', DB::raw($location))
            ->orderBy('distance','asc')
            ->get();
            $msg = "Ok";
        }
        

        return response()->json( compact("data","msg"), 200);
    }

    public function queryLocation($lat, $long){
        $lat = doubleval($lat);
        $long = doubleval($long);
        
        return " (
            (
                (
                    acos(
                        sin(( $lat * pi() / 180))
                        *
                        sin(( `latitud` * pi() / 180)) + cos(( $lat * pi() /180 ))
                        *
                        cos(( `latitud` * pi() / 180)) * cos((( $long - `longitud`) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515 * 1.609344
        ) as distance";
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    public function index(){
        $data = Ad::select('url','tiempo')->get();
        $msg = "Ok";
        return response()->json( compact("data","msg"), 200);
    }
}

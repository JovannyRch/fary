<?php

namespace App\Http\Controllers\Dashboard;

use App\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreNegocioPut;
use App\Http\Requests\StoreNegocioPost;
use Illuminate\Support\Facades\Auth;

class NegociosController extends Controller
{
    public function index(){
        $data = DB::table('negocios')->
        join('users', 'users.id', '=', 'negocios.owner_id')
        ->select('negocios.*', 'users.name as username')
        ->orderBy('created_at','desc')
        ->paginate(15);
        $total = sizeof($data);
        return view('admin.negocios.index',['negocios' => $data, 'total' => $total]);
    }

    public function create(){
        $tipos = DB::table('tipos')->get();
        $owners = DB::table('users')->select('id','name')->where('rol', 'owner')->get();
        return view('admin.negocios.create',['negocio' => new Negocio(), 'owners' => $owners, "tipos" => $tipos]);
    }

    public function edit(Negocio $negocio){
        $tipos = DB::table('tipos')->get();
        $owners = DB::table('users')->select('id','name')->where('rol', 'owner')->get();
        return view('admin.negocios.edit',['negocio' => $negocio,'owners' => $owners, "tipos" => $tipos]);
    }

    public function store(StoreNegocioPost $request){
       
        $data = $request->validated();
       
        $negocio = Negocio::create($data);
      
        $tipos = $request->tipos;
        
        if($request->hasFile('img')){
            $filename = time().".".$request->img->extension();
            $request->img->move(public_path('images'),$filename);
            $negocio->img = '/images/'.$filename; 
        }
        foreach ($tipos as $tipo ) {
            DB::insert('INSERT into tipos_negocios(negocio_id,tipo_id,created_at,updated_at) values(?,?,NOW(),NOW())', [$negocio->id, $tipo]);
        }


        $negocio->save();

        if(Auth::user()->rol == 'admin'){
            return redirect()->route('negocios.edit', [$negocio])->with('msg','Negocio guardado con éxito.');
        }
        else {
            return redirect('/');
        }
    }

    public function update(StoreNegocioPut $request, Negocio $negocio){
        $data = $request->validated();
      
        $tipos = $request->tipos;
        DB::delete('delete from tipos_negocios where negocio_id = ?',[$negocio->id]);
        foreach ($tipos as $tipo ) {
            DB::insert('INSERT into tipos_negocios(negocio_id,tipo_id,created_at,updated_at) values(?,?,NOW(),NOW())', [$negocio->id, $tipo]);
        }
        if($request->hasFile('img')){
            $this->deleteFile($negocio->img);
            $filename = time().".".$request->img->extension();
            $request->img->move(public_path('images'),$filename);
            $negocio->img = '/images/'.$filename; 
        }
        $negocio->name = $request->name;
        $negocio->address = $request->address;
        $negocio->phone = $request->phone;
        $negocio->email = $request->email;
        $negocio->owner_id = $request->owner_id;
        $negocio->latitud = $request->latitud;
        $negocio->longitud   = $request->longitud ;
        $negocio->save();
        return back()->with('msg','Negocio guardado con éxito.');
    }


    public function destroy(Negocio $negocio){
        try {
            $this->deleteFile($negocio->img);
            $negocio->delete();
            return back()->with('msg','Eliminación correcta');
        } catch (\Throwable $th) {
            return back()->with('warning','Ocurrio un error al eliminar el usuario');
        }
    }

    public function deleteFile($path){
        $path = substr($path,1,strlen($path)-1);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}

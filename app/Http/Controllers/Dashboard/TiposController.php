<?php

namespace App\Http\Controllers\Dashboard;

use App\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiposController extends Controller
{
    public function index(){
        $data = Tipo::get();
        return view('admin.tipos.index',['tipos' => $data]);
    }

    public function create(){
        return view('admin.tipos.create',['tipo' => new Tipo()]);
    }

    public function edit(Tipo $tipo){
        return view('admin.tipos.edit', ["tipo" => $tipo]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|unique:tipos|max:255',
        ]);
        
        $tipo = new Tipo();
        $tipo->name = $request->name; 
        $tipo->save();

        return back()->with('msg',"Tipo de negocio creado exitosamente.");

    }


    public function update(Request $request, Tipo $tipo){
        $data = $request->validate([
            'name' => 'required|unique:tipos|max:255',
        ]);

        $tipo->update($data);
        return back()->with('msg',"Tipo de negocio actualizado correctamente.");

    }

    public function destroy(Tipo $tipo){
        try {
            $tipo->delete();
            return back()->with('msg','Eliminación de tipo de negocio correcta');
        } catch (\Throwable $th) {
            return back()->with('warning','Ocurrio un error al eliminar el tipo de negocio');
        }
    }
}

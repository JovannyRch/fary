<?php

namespace App\Http\Controllers\Dashboard;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function index()
    {   
        $ads = Ad::with('negocio')->paginate(15);
        
        $total = sizeof($ads);
        return view('admin.ads.index', ['ads' => $ads, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $negocios = DB::table('negocios')->get();
        return view('admin.ads.create', ['negocios' => $negocios,'ad' => new Ad()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'negocio_id' => 'required',
            'file' => 'required|mimes:jpeg,jpg,bmp,png,mp4',
            'tiempo' => 'required',
        ]);

        $filename = time().".".$request->file->extension();
        $request->file->move(public_path('images'),$filename);
        $url = '/images/'.$filename; 
        
        $ad = new Ad();
        $ad->url = $url;
        $ad->negocio_id = $request->negocio_id;
        $ad->tiempo = $request->tiempo;
        $ad->save();
      
        return back()->with("msg", "Anuncio creado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $negocios = DB::table('negocios')->get();
        return view('admin.ads.edit', ['negocios' => $negocios,'ad' => $ad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'negocio_id' => 'required',
            'file' => 'nullable|mimes:jpeg,jpg,bmp,png,mp4',
            'tiempo' => 'required'
        ]);
        
        if($request->hasFile('file')){
            $filename = time().".".$request->file->extension();
            $request->file->move(public_path('images'),$filename);
            $url = '/images/'.$filename; 
            $this->deleteFile($ad->url);
            $data['url'] = $url;
        }
        unset($data['file']);
        $ad->update($data);
        return back()->with('msg','Anuncio actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {   
        try {
            $this->deleteFile($ad->url);
            $ad->delete();

            return back()->with('msg','Se eliminó correctamente la publicidad');
        } catch (\Throwable $th) {
            return back()->with('warning','Ocurrio un error al eliminar la publicidad');
        }
    }

    public function deleteFile($path){
        $path = substr($path,1,strlen($path)-1);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subchapter;
use App\Chapter;
use App\Challenge;
Use App\Insignia;
use App\User;
use App\Log;
use Auth;
use DB;

class SubcapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //
    }

    public function pasarcapitulo($id)
    {        
        return view('admin.subcapitulosCreate')->with('capitulo', $id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userauthid = Auth::user()->id;

        $subcapitulo = new Subchapter;
        $subcapitulo->name = $request->name;
        $subcapitulo->title = $request->title;
        $subcapitulo->order = $request->order;
        $subcapitulo->time = $request->time;
        $subcapitulo->description = $request->description;
        $subcapitulo->chapter_id = $request->chapter_id;
        $subcapitulo->competence_id = $request->competencias; 
        $subcapitulo->save();


        //registro de LOGS
        Log::create([
            'model_name' => 'App\Subchapter',
            'recurso_id' => $subcapitulo->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'un Subcapitulo ha sido Creado'
        ]);

        //guardar campos en la tabla pivote, con campo orden SUBCHAPTER_USER
        $useraddsubchapter = $request->userasignado;
        if($useraddsubchapter != ''){
         $pivotData = array_fill(0, count($useraddsubchapter), ['order' => $request->order, 'chapter_id' => $request->chapter_id ]);
         $syncData = array_combine($useraddsubchapter, $pivotData); 
         $subcapitulo->users()->sync($syncData);
        }
        
        $capitulos = Chapter::find($request->chapter_id);
        return view('admin.subcapitulos')->with('capitulos', $capitulos);
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
        $capitulos = Chapter::find($id);
        return view('admin.subcapitulos')->with('capitulos', $capitulos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //obtener datos relacionados
        $sunchaprelated = Subchapter::all();

        $arraydatos[] = 0;
        foreach($sunchaprelated as $subchap){
            $datos = Subchapter::find($subchap->id);
            foreach ($datos->users as $dato) {
                $datosid = $dato->pivot->pivotParent;
                $arraydatos[] = $datosid;            
            }
        }
        $elarray = array_unique($arraydatos);
        //limpiar el array le esta saliendo un item 0
        $userselecteds = array_splice($elarray, 1);

        $subcapitulo = Subchapter::find($id);
        return view('admin.subcapitulosUpdate')->with('subcapitulo', $subcapitulo)->with('userselecteds', $userselecteds);      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subchapterupdate = Subchapter::find($id);
        $subchapterupdate->name = $request->name;
        $subchapterupdate->title = $request->title;
        $subchapterupdate->order = $request->order;
        $subchapterupdate->time = $request->time;
        $subchapterupdate->description = $request->description;
        $subchapterupdate->chapter_id = $request->chapter_id;
        $subchapterupdate->competence_id = $request->competencias; 
        $subchapterupdate->save();

        //guardar campos en la tabla pivote, con campo orden SUBCHAPTER_USER
        $useraddsubchapter = $request->userasignado;
        //return $useraddsubchapter;
        if($useraddsubchapter != ''){
            $pivotData = array_fill(0, count($useraddsubchapter), ['order' => $request->order, 'chapter_id' => $request->chapter_id ]);
            $syncData = array_combine($useraddsubchapter, $pivotData); 
            $subchapterupdate->users()->sync($syncData);  

        }
        
        $capitulos = Chapter::find($request->chapter_id);
        return view('admin.subcapitulos')->with('capitulos', $capitulos);

        //Subchapter::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competence;
use App\Subchapter;
use App\Log;
use Auth;
use DB;

class CompetenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status="";
        
        //dirigir a la vista competencias listas con todas las competencias en la base de datos
        $competences = Competence::all();        
        return view('admin.competencias')->with('competences', $competences)
                                        ->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.competenciasCreate');
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
        $status="";
        $userauthid = Auth::user()->id;
        
        $competencias = new Competence;
        $competencias->name = $request->name;
        $competencias->description = $request->descripcion;
        $competencias->save();

        //registro de LOGS
        Log::create([
            'model_name' => 'App\Competence',
            'recurso_id' => $competencias->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'Una Competencia ha sido Creada'
            ]);
            
        $competences = Competence::all();        
        return view('admin.competencias')->with('competences', $competences)
                                        ->with('status', $status);
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
    public function edit($id)
    {
        //
        $competencia = Competence::find($id);
        return view('admin.competenciaEdit')->with('competence', $competencia);
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
        //
        $status="";
        
        //actualizar competencia
        $competencia = Competence::find($id);
        $competencia->name = $request->name;
        $competencia->description = $request->desc;    
        $competencia->save();
        
        $competences = Competence::all();        
        return view('admin.competencias')->with('competences', $competences)
                                        ->with('status', $status);
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
        $competencia = Competence::find($id);
        
        $status="";
        $count=0;
        
        $count+=count($competencia->subchapters);
        
        if ($count>0) {
            $status = 'La Competencia esta relacionada, Imposible eliminar';
        } else {
            Competence::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        $competences = Competence::all();        
        return view('admin.competencias')->with('competences', $competences)
                                        ->with('status', $status);
    }
}

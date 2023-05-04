<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Position;
use App\Log;
use DB;
use Auth;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = "";
        //
        $areas = Area::all();        
        return view('admin.areas')->with('areas', $areas)
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
        return view('admin.AreasCreate');

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $status = "";
        $userauthid = Auth::user()->id;

        $area = new Area;
        $area->name = $request->name;
        $area->description = $request->desc;
        
        $area->save();
        
        //registro de LOGS
        Log::create([
            'model_name' => 'App\Area',
            'recurso_id' => $area->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'Area ha sido Creada'
        ]);

        $areas = Area::all();        
        return view('admin.areas')->with('areas', $areas)
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

    public function areasregistro()
    {
        $areas = Area::all();        
        return response()->json($areas);
    }

    public function positionsregistro($id)
    {
        $position = Area::find($id);        
        return response()->json($position->positions);
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
        $areas = Area::find($id);
        return view('admin.AreasEdit')->with('area', $areas);
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
        $status = "";
        //actualizar el Area
        $area = Area::find($id);
        $area->name = $request->name;
        $area->description = $request->desc;    
        $area->save();
       
        $areas = Area::all();        
        return view('admin.areas')->with('areas', $areas)
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
        $areas = Area::find($id);
        
        $status="";
        $count=0;
        
        $count+=count($areas->users);
        
        if ($count>0) {
            $status = 'Area esta relacionada, Imposible eliminar';
        } else {
            Area::find($id)->users()->detach();
            Area::find($id)->positions()->detach();            
            Area::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        $wareas = Area::all();        
        return view('admin.areas')->with('areas', $wareas)
                                ->with('status', $status);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Area;
use App\Log;
use Auth;
use DB;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status="";
        
        $cargos = Position::all();          
        return view('admin.cargos')->with('cargos', $cargos)
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
        $areas = Area::all();
        return view('admin.CargosCreate')->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:challenges|max:255',            
            'area' => 'required',
            'desc' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre para el Cargo',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'name.unique' => 'Este Cargo ya existe',
            'area.required' => 'Debes ingresar un Area para el cargo',
            'desc.required' => 'Ingresa una descripcion',
            
        ];         
        $this->validate($request, $rules, $messages);
        
        $status="";        

        $userauthid = Auth::user()->id;
        
        $cargo = new Position;
        $cargo->name = $request->name;
        $cargo->description = $request->desc;

        $cargo->save();
        $cargo->areas()->attach($request->area);    
        
        //registro de LOGS
        Log::create([
            'model_name' => 'App\Position',
            'recurso_id' => $cargo->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'un Cargo ha sido Creado'
            ]);
            
            $cargos = Position::all();        
            return view('admin.cargos')->with('cargos', $cargos)
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
        $areas = Area::all();
        
        $cargos = Position::find($id);
        return view('admin.CargosEdit')->with('cargos', $cargos)
                                ->with('areas', $areas);
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
        $status="";    
        //actualizar el cargo
        $cargo = Position::find($id);
        $cargo->name = $request->name;
        $cargo->description = $request->desc;    
        $cargo->areas()->detach(); 
        $cargo->save();
        $cargo->areas()->attach($request->area); 


       
        $cargos = Position::all();        
        return view('admin.cargos')->with('cargos', $cargos)
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
        //eliminar relacion de jefes
        $positionuser = Position::find($id);   
            
        $status="";
        $count=0;
        
        $count+=count($positionuser->users);
        
        if ($count>0) {
            $status = 'Cargo esta relacionada, Imposible eliminar';
        } else {
            foreach ($positionuser->users as $positionrelated) {            
                $positionuser->users()->detach($positionrelated->id);
            }
    
            foreach ($positionuser->areas as $positionrelated) {            
                $positionuser->areas()->detach($positionrelated->id);
            }

            Position::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        $cargos = Position::all();        
        return view('admin.cargos')->with('cargos', $cargos)
                                    ->with('status', $status);
    }
}

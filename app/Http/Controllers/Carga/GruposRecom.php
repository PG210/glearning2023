<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AreaPModel\GrupecompensaModel;
use Illuminate\Support\Facades\Session;

class GruposRecom extends Controller
{
    public function index()
    {
        // Acción para mostrar el formulario de creación
        $info = GrupecompensaModel::all();
        return view('admin.Gruporecompensas')->with('info', $info);
    }

    public function store(Request $request){
       $val = GrupecompensaModel::where('nombre', $request->name)->count();
       if($val == 0){
            $Guardar = new GrupecompensaModel();
            $Guardar->nombre = $request->name;
            $Guardar->tipo = $request->tipo;
            $Guardar->descrip = $request->descrip;
            $Guardar->save();
            Session::flash('gr', 'Grupo creado correctamente!');
        }else{
            Session::flash('gr', 'El nombre del grupo debe ser único.');
        }
        return back();
    }

    public function show($id){
       $up =  GrupecompensaModel::where('id', $id)->get();
       return view('admin.gacturecom')->with('up', $up);
    }
    //eliminar

    public function actu(Request $request){
        $up =  GrupecompensaModel::findOrfail($request->iden);
        $up->nombre = $request->name;
        $up->tipo = $request->tipo;
        $up->descrip = $request->descrip;
        $up->save();
        $info =  GrupecompensaModel::all();
        return view('admin.Gruporecompensas')->with('info', $info);
    }

    public function destroy($id){
       
    }
}

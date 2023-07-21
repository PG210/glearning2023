<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AreaPModel\CategoriaRecompensa;
use Illuminate\Support\Facades\Session;

class GruposInsignias extends Controller
{
    public function formularioreg(){
        $info = CategoriaRecompensa::all();
        return view('admin.FormugruposInsignias')->with('info', $info);
    }

    public function registrarCategoria(Request $request){
        $validar = CategoriaRecompensa::where('nombre', $request->name)->count();
        if($validar == 0){
            $categ = new CategoriaRecompensa();
            $categ->nombre = $request->name;
            $categ->tipo = $request->tipo;
            $categ->descrip = $request->descrip;
            $categ->save();
            Session::flash('cat', 'Categoría creada exitosamente!');
        }else{
            Session::flash('cat', 'La categoría ya existe!');
        }
       $info = CategoriaRecompensa::all();
       return back()->with('info', $info);
    }

    public function formeditar($id){
      $buscar =  CategoriaRecompensa::findOrfail($id);
      return view('admin.editarCategoria')->with('up', $buscar);
    }

    public function regisEditCat(Request $request){
        $categ =  CategoriaRecompensa::findOrfail($request->iden);
        $categ->nombre = $request->name;
        $categ->tipo = $request->tipo;
        $categ->descrip = $request->descrip;
        $categ->save();
        Session::flash('cat', 'Categoría actualizada exitosamente!');
        return back();
    }
}

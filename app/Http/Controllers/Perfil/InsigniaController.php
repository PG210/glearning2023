<?php

namespace App\Http\Controllers\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\InsigniaCap;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class InsigniaController extends Controller
{
   public function index(){
    $info = InsigniaCap::all();
    return view('admin.incap')->with('info', $info);
   }
   public function guardar(Request $request){
      //vliar el capitulo si ya esta guardado
      $contar = DB::table('insigniacap')->where('capitulo', $request->cap)->count();
      if($contar == 0){
         //###########################
         $file = $request->file('ruta');//guarda la variable id en un file
         $name = $file->getClientOriginalName();
         $limpiarnombre = str_replace(array("#",".",";"," "), '', $name);
         $val = $limpiarnombre.".".$file->guessExtension();//renombra el archivo subido
         $ruta = public_path("insigcap/".$val);//ruta para guardar el archivo pdf/ es la carpeta
         copy($file, $ruta);
         //########################
         $category = new InsigniaCap();
         $category->nombre = $request->input('name');
         $category->descripcion = $request->input('des');
         $category->capitulo = $request->input('cap');
         $category->url = $val;
         $category->save();
         Session::flash('msj', 'Datos guardados exitosamente!');
      }else{
         Session::flash('msj', 'Capitulo duplicado!');
      }
      $info = InsigniaCap::all();
      return back()->with('info', $info);
   }
   //eliminar
   public function eliminar($id){
      InsigniaCap::findOrFail($id)->delete();
      $info = InsigniaCap::all();
      Session::flash('msj', 'Insignia eliminada correctamente!');
      return back()->with('info', $info);
   }
}

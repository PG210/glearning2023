<?php

namespace App\Http\Controllers\Carga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
use App\Archivos\Cargarchivo;


use App\User;
use App\Position;
use App\Area;
use DB;
use App\AreaPModel\AreaPos;
use App\PosUsuModel\PosUsu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class SubirArchivoController extends Controller
{
    //

    public function index(Request $request, SessionManager $sessionManager){

      
        //$request->file('archivo')->store('public');
        //dd("subido y guardado");

            if($request->hasFile('uploadedfile')){
                
                $category = new Cargarchivo();
               
                $file = $request->file('uploadedfile');//guarda la variable id en un file
                $name = $file->getClientOriginalName();
                $limpiarnombre = str_replace(array("#",".",";"," "), '', $name);
                $val = $limpiarnombre.".".$file->guessExtension();//renombra el archivo subido
                $ruta = public_path("csv/".$val);//ruta para guardar el archivo pdf/ es la carpeta

                
                if($file->guessExtension()=="txt"){
                  
                 copy($file, $ruta);
                 $category->descripcion = $request->input('nombre');
                 $category->ruta = $val;//ingresa el nombre de la ruta a la base de datos
                 $category->save();//guarda los datos
                    //$lines = file($rut);
                    //$utf= array_map('utf8_encode', $lines);
                    //$array =array_map('str_getcsv', $utf);


                    //$sessionManager->flash('mensaje', '');
                    return redirect()->route('cargamasiva')->with('mensaje', 'Archivo cargado con exito');
                }
             
                else{
                    return redirect()->route('cargamasiva')->with('mensaje', 'Archivo no fue cargado');
                }
              
        }
    }

    public function cargar(){
      // $rut = public_path('csv/usuarioscsv.txt');
      // $lines = file($rut);
       //$utf= array_map('utf8_encode', $lines);
        //$array = array_map('str_getcsv', $utf); //datos normalizados
       
           // $msj='';
            $listado = Cargarchivo::all();
                return view('admin.lista_archivos', compact('listado'));
            
        
    }
    public function registrar($file_name){
      $contador=0;
      $c=0;
      $f=0;
       $rut = public_path('csv/'.$file_name);
       $lines = file($rut);
      
       $utf= array_map('utf8_encode', $lines);
       $array = array_map('str_getcsv', $utf); //datos normalizados
       //return $array;
       //validar que el documento este completo
       $tam = sizeof($array);
       if($tam > 1){
        for($k=1; $k<sizeof($array); ++$k){
            for($j=0; $j<=10; ++$j){
             if(!isset($array[$k][$j])){
                $msj="Lo sentimos! El archivo debe tener todos los campos completos o verifique que este delimitado por comas.";
                return back()->with('mensaje',$msj);
             }
            }
        }
      }
       //end validar datos completos
      for($i=1; $i<sizeof($array); ++$i){
            if(isset($array[$i][6])){

            $usern= $array[$i][6];
            $userem = $array[$i][2];
           
            $datovalidar = DB::table('users')->where('username', '=', $usern)->count();
            $validaremail = DB::table('users')->where('email', '=', $userem)->count();
           
            if($datovalidar==0 && $validaremail==0){

              $category = new User();
              $category->firstname=$array[$i][0];
              $category->lastname=$array[$i][1];
              $category->avatar_id=$array[$i][9];
              $category->sexo=$array[$i][3];
              $category->username= $array[$i][6];
              $category->email= $array[$i][2];
              if(is_numeric($array[$i][10])){
                $category->id_grupo = $array[$i][10]; //id_grupo
              }else{
                $category->id_grupo = 1; //id_grupo
              }
              $category->password=Hash::make($array[$i][7]);
              $category->save();
                //debe registrar los datos en la tabla area
              $Ar = new AreaPos();
              $Pos =new PosUsu();
              $consul = User::all()->where('username', '=', $array[$i][6])->first();
              //realizar la consulta para que siempre sea area=evolucion de lo contrario
              //si modifica el area puede que el programa deje de funcionar
              $ev="Evolucion";
              $area_user_con= DB::table('areas')->where('name', '=', $ev)->first();
              $Ar -> area_id=$area_user_con->id;
              $Ar->user_id = $consul->id;
              $Ar ->save();
              
              //position_user
              $Pos->user_id = $consul->id;
              $pos_user_con = DB::table('positions')->where('name', '=', $ev)->first();
              $Pos->position_id = $pos_user_con->id;
              $Pos->save();       

            }
          }
           
         }
         $msj="¡Usuarios Registrados Éxitosamente!";
         return back()->with('mensaje',$msj);
    }

  public function eliminar($id){
    //$category = new Cargarchivo();
    $elim = Cargarchivo::findOrfail($id);
    $nom=$elim->ruta;
    $elim->delete();
    $msj="¡Archivo Eliminado: ".$nom.", Eliminado con exito!";
    return back()->with('mensaje',$msj);
  }
       

}

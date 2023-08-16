<?php

namespace App\Http\Controllers\RegController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Position;
use App\Area;
use App\AreaPModel\AreaPos;
use App\PosUsuModel\PosUsu;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use App\PosUsuModel\SubcapUser;//se agrego esta parte

class RegunicoController extends Controller
{
    public function index(){
    $avat = DB::table('avatars')->get();
    $grup = DB::table('grupos')->get();
    return view('admin.regunicouser')->with('avat', $avat)->with('grup', $grup);
    }

    public function regunico(Request $request){
          //validar el usuario
          //############################################
          $gr = $request->input('grupo');
          //############################################
          $uval=$request->nameuser;
          $bususu = DB::table('users')->where('username', '=', $uval)->count();
          //validar Correo
          $ucorreo=$request->correo;
          $buscorreo = DB::table('users')->where('email', '=', $ucorreo)->count();
          if($bususu!=0){
            Session::flash('notuser', 'Usuario ya se encuentra registrado!'); 
          }else{
             if($buscorreo!=0){
                Session::flash('notcorreo', 'Correo ya se encuentra registrado!'); 
             }
             else{
                 //registrar usuario
                 $category = new User();
                 $Ar = new AreaPos();
                 $Pos =new PosUsu();
                 $category->firstname=$request->input('nombre');
                 $category->lastname=$request->input('apellido');
                 $category->avatar_id=$request->input('avatar');
                 $category->sexo=$request->input('sexo');
                 $category->username= $request->input('correo');
                 $category->email= $request->input('correo');
                 $category->cedula = $request->input('ced');

                 $category->id_grupo = $gr; //grupo por default
                 $category->password=Hash::make($request->input('password_confirmation'));
                 $category->save(); //aqui guarda los datos del usuario
                 //debe registrar los datos en la tabla area
                 $con = $request->nombre;
                 $consul = DB::table('users')->where('firstname', '=', $con)->first();

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

                 //agregar todos los usuarios pertenecientes a este grupo los capitulos correspondientes
                 //este codigo funciona siempre y cuando el grupo ya este agregado de lo contrario vamos a validar

                 $capitulos = DB::table('subchapter_user')
                           ->join('users', 'subchapter_user.user_id', '=', 'users.id')
                           ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                           ->select('grupos.id as idgrup', 'grupos.descrip', 'subchapter_user.chapter_id')
                           ->where('grupos.id', $gr)
                           ->distinct('chapter_id')
                           ->get();
                  //guardar info
                  if(!empty($capitulos)){
                        foreach($capitulos as $c){
                              $AddCap = new SubcapUser();
                              $AddCap->order = $c->chapter_id; // este es el capitulo
                              $AddCap->chapter_id = $c->chapter_id;
                              $AddCap->subchapter_id = 1;
                              $AddCap->user_id = $consul->id;
                              $AddCap->estado = 0;
                              $AddCap ->save();
                        }
                     }
                 // return $capitulos;
                 Session::flash('usu_reg', 'Usuario registrado con éxito!');
             }

          }
       return back();
    }
}

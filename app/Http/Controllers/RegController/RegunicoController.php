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

class RegunicoController extends Controller
{
    public function index(){
    $avat=DB::table('avatars')->get();
    
    return view('admin.regunicouser')->with('avat', $avat);
    }

    public function regunico(Request $request){
         
          //validar el usuario
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

                 $category->id_grupo = 1; //grupo por default
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

                 //return $consul->id;
                 Session::flash('usu_reg', 'Usuario registrado con éxito!');
             }

          }
       return back();
    }
}

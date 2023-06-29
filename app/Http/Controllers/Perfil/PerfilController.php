<?php

namespace App\Http\Controllers\Perfil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    public function index(){
        $idusu=auth()->id();
        $usu = DB::table('users')->where('users.id', '=', $idusu)
              ->join('avatars', 'users.avatar_id', '=', 'avatars.id')
              ->select('users.id as userid', 'users.firstname', 'users.lastname', 'users.username', 'users.sexo', 'users.email', 'users.avatar_id', 
                       'avatars.id', 'avatars.name', 'avatars.description', 'avatars.img')
              ->get();
        $avatar=DB::table('avatars')->where('avatars.sexo', '=', 'Femenino')->get();
        $avatarm=DB::table('avatars')->where('avatars.sexo', '=', 'Masculino')->get();
        //return $usu;
        return view('perfilusu')->with('usu', $usu)->with('avatar', $avatar)->with('avatarm', $avatarm);
    }

    public function actu(Request $request, $id){
        $p =  $request->input('pass');
        if($p!=null){
            $usuact =User::findOrfail($id);
            $usuact->firstname = $request->input('nombre');
            $usuact->lastname = $request->input('apellido');
            $usuact->sexo = $request->input('genero');
            $usuact->username = $request->input('usuario');
            $usuact->email = $request->input('email');
            $usuact->avatar_id = $request->input('avat');
            $usuact->password=Hash::make($p);
            $usuact->save();
            return redirect('/home');
        }else{
            $usuact =User::findOrfail($id);
            $usuact->firstname = $request->input('nombre');
            $usuact->lastname = $request->input('apellido');
            $usuact->sexo = $request->input('genero');
            $usuact->username = $request->input('usuario');
            $usuact->email = $request->input('email');
            $usuact->avatar_id = $request->input('avat');
            $usuact->save();
            return redirect('/home');
        }

    }

    //actualizar desde el admin
    public function actuadmin($id){
        
        $usu = DB::table('users')->where('users.id', '=', $id)
              ->join('avatars', 'users.avatar_id', '=', 'avatars.id')
              ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
              ->select('users.id as userid', 'users.firstname', 'users.lastname', 'users.username', 'users.sexo', 'users.email', 'users.avatar_id', 
                       'avatars.id', 'avatars.name', 'avatars.description', 'avatars.img', 'grupos.descrip as grupo', 'users.id_grupo as idgrupo')
              ->get();
        $avatar=DB::table('avatars')->where('avatars.sexo', '=', 'Femenino')->get();
        $avatarm=DB::table('avatars')->where('avatars.sexo', '!=', 'Femenino')->get();
        $grupos =DB::table('grupos')->select('id as idgrup', 'descrip')->get();
        //return $usu;
        return view('admin.vistaperfil')->with('usu', $usu)->with('avatar', $avatar)->with('avatarm', $avatarm)->with('grupos', $grupos);
    }

    //actualizar perfil de usuario desde el admin
   public function actualizarusuadmin(Request $request, $id){
        $actu =User::findOrfail($id);
        $actu->firstname = $request->input('nombre');
        $actu->lastname = $request->input('apellido');
        $actu->sexo = $request->input('genero');
        $actu->username = $request->input('usuario');
        $actu->email = $request->input('email');
        $actu->avatar_id = $request->input('avat');
        if($request->pass != Null){
            $actu->password=Hash::make($p);
        }
        $actu->id_grupo = $request->input('grupo');
        $actu->save();
        Session::flash('datreg', 'Usuario actualizado exitosamente!');
        return back();
   }
   //funcion que lleva a perfil
   public function perfilhomedos(){
        $idusu=auth()->id();
        $usu = DB::table('users')->where('users.id', '=', $idusu)
            ->join('avatars', 'users.avatar_id', '=', 'avatars.id')
            ->select('users.id as userid', 'users.firstname', 'users.lastname', 'users.username', 'users.sexo', 'users.email', 'users.avatar_id', 
                    'avatars.id', 'avatars.name', 'avatars.description', 'avatars.img')
            ->get();
        $avatar=DB::table('avatars')->where('avatars.sexo', '=', 'Femenino')->get();
        $avatarm=DB::table('avatars')->where('avatars.sexo', '=', 'Masculino')->get();
        //return $usu;
        return view('grupos.perfilusu')->with('usu', $usu)->with('avatar', $avatar)->with('avatarm', $avatarm);
   }
   //deshabilitar usuarios
   public function deshabilitar($id){
    $user = User::find($id);
    if($user->estado == 1){
        $user->estado = 0;
    }else{
        $user->estado = 1;
    }
    $user->save();
    return back();
   }

   //aqui insignia
   public function detinsignia($id){
    $usu =  Auth::user()->id;
    $info = DB::table('insignia_user')->join('users', 'insignia_user.user_id', '=', 'users.id')
           ->join('insignias', 'insignia_user.insignia_id', '=', 'insignias.id')
           ->where('insignia_user.id', $id)
           ->select('insignia_user.id', 'insignia_user.insignia_id as idinsig',
                     'users.firstname as usuname', 'users.lastname as usuape', 'insignias.name', 'insignias.imagen', 'insignias.description', 'insignia_user.created_at')
           ->get();
     return view('grupos.vistains')->with('info', $info);
   }
}

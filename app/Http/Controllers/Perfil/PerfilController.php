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
use App\PosUsuModel\SubcapUser;//se agrego esta parte
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use App\PosUsuModel\GrupadminModel;//se agrego esta parte

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
            $usuact->cedula = $request->input('ced');//cedula
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
            $usuact->cedula = $request->input('ced');//cedula
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
                       'avatars.id', 'avatars.name', 'avatars.description', 'avatars.img', 'grupos.descrip as grupo', 'users.id_grupo as idgrupo', 'users.cedula', 'users.admin')
              ->get();
        $avatar=DB::table('avatars')->where('avatars.sexo', '=', 'Femenino')->get();
        $avatarm=DB::table('avatars')->where('avatars.sexo', '!=', 'Femenino')->get();
        $grupos =DB::table('grupos')->select('id as idgrup', 'descrip')->get();
        //Consultar si el usuario tiene agregado grupos
        $addgrupos = DB::table('grupadmin')->where('idusu', $id)->get();
        //return $usu;
        return view('admin.vistaperfil')
                    ->with('addgrupos', $addgrupos)
                    ->with('usu', $usu)
                    ->with('avatar', $avatar)
                    ->with('avatarm', $avatarm)
                    ->with('grupos', $grupos);
    }

    //actualizar perfil de usuario desde el admin
   public function actualizarusuadmin(Request $request, $id){

        $gruposid = $request->idarchivo; //guarda los datos de check
          
       // return $request;
        $gr = $request->input('grupo');
        $p = $request->input('passw');

        $actu =User::findOrfail($id);
        $actu->firstname = $request->input('nombre');
        $actu->lastname = $request->input('apellido');
        $actu->sexo = $request->input('genero');
        $actu->username = $request->input('usuario');
        $actu->email = $request->input('email');
        $actu->avatar_id = $request->input('avat');
        if($request->passw != Null){
           
            $actu->password=Hash::make($p);
        }
         //#########################
        //validar que al cambiar de grupo se debe vincular nuevamente la info.
        //return $actu->id_grupo;
        if ($actu->id_grupo == $gr){
            $actu->id_grupo = $gr;
        }else{
            SubcapUser::where('user_id', $id)->delete();
            //validar que el grupo nuevo ya tenga capitulos asignados
            $capitulos = DB::table('subchapter_user')
                        ->join('users', 'subchapter_user.user_id', '=', 'users.id')
                        ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                        ->select('grupos.id as idgrup', 'grupos.descrip', 'subchapter_user.chapter_id')
                        ->where('grupos.id', $gr)
                        ->distinct('chapter_id')
                        ->get();
            if(!empty($capitulos)){
                foreach($capitulos as $c){
                        $AddCap = new SubcapUser();
                        $AddCap->order = $c->chapter_id; // este es el capitulo
                        $AddCap->chapter_id = $c->chapter_id;
                        $AddCap->subchapter_id = 1;
                        $AddCap->user_id = $id;
                        $AddCap->estado = 0;
                        $AddCap ->save();
                }
                }
                $actu->id_grupo = $gr;
            
        }
        //#############################
        $actu->save();
        //##################### Guardar en la tabla de grupos ################

        if(!is_null($gruposid)){
            DB::table('grupadmin')->where('idusu', $id)->delete();
            foreach ($gruposid as $valor){
                $ver = DB::table('grupadmin')->where('idusu', $id)->where('idgrupo', $valor)->count();
                if($ver == 0){
                    $Add = new GrupadminModel();
                    $Add->idusu = $id;
                    $Add->idgrupo = $valor;
                    $Add->save();
                }
               
              }
          }

        //################################################
        Session::flash('datreg', 'Usuario actualizado exitosamente!');
        return back();
   }
   //funcion que lleva a perfil
   public function perfilhomedos(){
        $idusu=auth()->id();
        $usu = DB::table('users')->where('users.id', '=', $idusu)
            ->join('avatars', 'users.avatar_id', '=', 'avatars.id')
            ->select('users.id as userid', 'users.firstname', 'users.lastname', 'users.username', 'users.sexo', 'users.email', 'users.cedula', 'users.avatar_id', 
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

   //aqui insignia que viene desde el popup compartir
   public function detinsignia($id){
    if (Auth::check()) {
    $usu =  Auth::user()->id;

    $info = DB::table('insigcap_user')
           ->join('users', 'insigcap_user.userid', '=', 'users.id')
           ->join('insigniacap', 'insigcap_user.insigid', '=', 'insigniacap.id')
           ->where('insigcap_user.insigid', $id)
           ->where('insigcap_user.userid', $usu)
           ->select('insigcap_user.id', 'insigcap_user.insigid as idinsig',
                     'users.firstname as usuname', 'users.lastname as usuape', 'users.cedula', 'insigniacap.nombre as name', 
                     'insigniacap.url as imagen', 'insigniacap.descripcion as description', 'insigcap_user.created_at', 'insigniacap.horas')
           ->get();
           //return $info;
    
     return view('grupos.vistains')->with('info', $info);
    }else{
        return redirect('https://glearning.com.co/');
    }
   }

   //aqui validarla inignia que viene desde la vista de recompensas

   public function insigniaVisu($id){

    $info = DB::table('insigcap_user')
           ->join('users', 'insigcap_user.userid', '=', 'users.id')
           ->join('insigniacap', 'insigcap_user.insigid', '=', 'insigniacap.id')
           ->where('insigcap_user.id', $id)
           ->select('insigcap_user.id', 'insigcap_user.insigid as idinsig',
                     'users.firstname as usuname', 'users.lastname as usuape', 'users.cedula', 'insigniacap.nombre as name', 
                     'insigniacap.url as imagen', 'insigniacap.descripcion as description', 'insigcap_user.created_at', 'insigniacap.horas')
           ->get();
           //return $info;
     return view('grupos.vistains')->with('info', $info);
   }

   //generar pdf
   public function generarPDF()
        {
            $data = ['title' => 'Mi PDF'];
            $pdf = new Dompdf();
            $pdf->loadHtml(View::make('grupos.pdfinsig', $data)->render());
            $pdf->setPaper('A4');
            $pdf->render();
            $pdf->stream('nombre_del_archivo.pdf');
        }
   //end pdf
   
   //###############################
   public function vistamaterial(){
    $user=auth()->id();
    $tTareas = DB::table('challenges')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->selectRaw('subchapters.chapter_id as cap, COUNT(challenges.id) as tareas')
                ->groupBy('subchapters.chapter_id')
                ->get();
    $tareasuser = DB::table('challenge_user')
                ->join('challenges', 'challenge_user.challenge_id', '=', 'challenges.id')
                ->join('subchapters', 'challenges.subchapter_id', '=', 'subchapters.id')
                ->join('chapters', 'subchapters.chapter_id', '=', 'chapters.id')
                ->where('challenge_user.user_id', $user)
                ->selectRaw('challenge_user.user_id as idusu, subchapters.chapter_id, COUNT(challenge_user.challenge_id) as valor, chapters.name, chapters.title')
                ->groupBy('challenge_user.user_id', 'subchapters.chapter_id', 'chapters.name', 'chapters.title')
                ->get();
    
    if(isset($tareasuser) && count($tareasuser) == 0){
            $buscar = [];
            $al = [];
            $niveles =[];

            }else{
            //##########################################
            foreach($tTareas as $t1){
            $conta = 0;
            foreach($tareasuser as $t2){
            if($t1->cap == $t2->chapter_id){
                $sum = $t1->tareas - $t2->valor;
                $conta = $conta+1;
                $item = [
                'usuario' => $t2->idusu,
                'capitulo' => $t2->chapter_id,
                'nombre' => $t2->name,
                'titulo' => $t2->title,
                'tcom' => $t2->valor,
                'tfaltan' => $sum,
                'ttotal' => $t1->tareas,
                'nivel' => $conta
                ];
                $al[] = $item;
               }
            }
         }
            $niveles = collect($al)->groupBy('usuario')->map(function ($items) {
                return count($items);
             });
     }
    
    return view('grupos.vistamat')->with('ninfo', $al);
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subchapter;
use App\User;
use App\Challenge;
use App\Area;
use App\Position;
use Auth;
use DB;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countusers = DB::table('users')->count();
        $status="";

        //$users = User::all();
         $users = DB::table('users')
                 ->join('grupos', 'users.id_grupo', '=', 'grupos.id')
                 ->select('users.id', 'firstname', 'lastname', 'username', 
                          'email', 'level', 's_point', 'i_point', 'g_point', 'users.created_at', 'estado', 'grupos.descrip')
                 ->orderBy('users.id', 'ASC')->paginate(30); //aqui hace la paginacion de usuarios
        return view('admin.usuarios', [
            'users' => $users,
            'countusers' => $countusers,
        ])->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Auth::logout();
        return Redirect('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $usuarios = User::find($id);     
        $areas = $usuarios->areas()->first();
        $position = $usuarios->positions()->first();

        $avatars = DB::table('avatars')->get();    
        return view('admin.usuariosEdit')
                                ->with('usuarios', $usuarios)
                                ->with('avatars', $avatars)
                                ->with('areas', $areas)
                                ->with('positions', $position);
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
        //
        $this->validate(request(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find($id);

        //DB::table('users')->where('id', '=', $id)->delete();
        
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->avatar_id = $request->avatar_id;
        $user->sexo = $request->AvatarSexo;

        $user->save();

        return back();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $users = User::find($id);
        $allusers = User::all();
        //codigo actualizado
        $area = DB::table('area_user')->where('user_id', '=', $id)->delete();
        $puser = DB::table('position_user')->where('user_id', '=', $id)->delete();
        $challenge = DB::table('challenge_user')->where('user_id', '=', $id)->delete();
        $gitf= DB::table('gift_user')->where('user_id', '=', $id)->delete();
        $quiz=DB::table('quiz_participant_answers')->where('user_id', '=', $id)->delete();
        $read=DB::table('readings')->where('id_user', '=', $id)->delete();
        $subchap=DB::table('subchapter_user')->where('user_id', '=', $id)->delete();
        $type=DB::table('type_user')->where('user_id', '=', $id)->delete();
        $videos=DB::table('videos')->where('id_user', '=', $id)->delete();
        $cause =DB::table('cause_user')->where('user_id', '=', $id)->delete();
        $ingusu =DB::table('insignia_user')->where('user_id', '=', $id)->delete();
        $log_changes=DB::table('log_changes')->where('user_id', '=', $id)->delete();
        $mensaje=DB::table('messages')->where('id_user', '=', $id)->delete();
        $outdoors=DB::table('outdoors')->where('id_user', '=', $id)->delete();
        $pictures=DB::table('pictures')->where('id_user', '=', $id)->delete();
        $insigcap = DB::table('insigcap_user')->where('userid', '=', $id)->delete();
        $users ->delete();
        Session::flash('eliminado', 'Usuario eliminado con éxito!');
        return back();
        //$puser->delete();
       // $users->delete();
        //return back();

      /* $status="";
        $count=0;
        $countuserchallenge=0;
        $countaea=0;
        
        $countuserchallenge+=count($users->challenges);
        $countaea+=count($users->areas);
        $count+=count($users->subchapters);
        

        if ($count>0 || $countuserchallenge>0) {
            $status = 'El Usuario esta relacionado con un Subcapitulo o alguna Actividad, Imposible eliminar';
        } else {
            User::find($id)->areas()->detach();
            User::find($id)->positions()->detach();
            User::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        return view('admin.usuarios')->with('status', $status)->with('users', $allusers);   */             
    }
}

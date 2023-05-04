<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Type;
use App\Area;
use App\Log;
use App;
use DB;
use Auth;

class JefeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $tipos = Type::all();
        $area = Area::all();

        //obtener datos relacionados con tabla pivot COMO DEBE SER!!!!
        $arraydatos[] = 0;
        foreach($users as $user){
            $datos = App\User::find($user->id);
            foreach ($datos->types as $dato) {
                $datosid = $dato->pivot->pivotParent;
                $arraydatos[] = $datosid;            
            }
        }
        $elarray = array_unique($arraydatos);
        
        //limpiar el array le esta saliendo un item 0
        $cleararray = array_splice($elarray, 1);


        //enviar datos a la vista       
        return view('admin.Jefes')->with('users', $users)
                                ->with('types', $tipos)
                                ->with('areas', $area)
                                ->with('elarray', $cleararray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'usuarios' => 'required',
            'tipojefe' => 'required|integer',
            'areas'    => 'required',
        ];   
        $messages = [
            'usuarios.required' => 'Debes Elegir un usuario',
            'tipojefe.required' => 'Debes Elegir un Tipo de Jefe',
            'tipojefe.not_in' => 'Debes Elegir un Tipo de Jefe', 
            'areas.required' => 'Debes elegir minimo un area para asignas al Jefe',           
        ];

        $this->validate($request, $rules, $messages);

        $users = User::all();
        $tiposboss = Type::all();
        $arebossa = Area::all();       
        $userauthid = Auth::user()->id;

        //guardar los tipos de jefe y areas asignadas a un usuario especfico AREA JEFES
        $tipos = new User;                
        foreach ($request->areas as $area) {
            
            $tipos->types()
                    ->attach($area, [
                            'id_areas' => $area,
                            'type_id' => $request->tipojefe, 
                            'user_id' => $request->usuarios, 
                            ]);               
        }

        //registro de LOGS
        Log::create([
            'model_name' => 'App\User',
            'recurso_id' => $request->usuarios,
            'user_id' => $userauthid,
            'accion_realizada' => 'Se ha asignado un Jefe'
        ]);

        $users = User::all();
        $tipos = Type::all();
        $area = Area::all();

        //obtener datos relacionados con tabla pivot COMO DEBE SER!!!!
        $arraydatos[] = 0;
        foreach($users as $user){
            $datos = App\User::find($user->id);
            foreach ($datos->types as $dato) {
                $datosid = $dato->pivot->pivotParent;
                $arraydatos[] = $datosid;            
            }
        }
        $elarray = array_unique($arraydatos);
        //limpiar el array le esta saliendo un item 0
        $cleararray = array_splice($elarray, 1);
        
        $users = User::all();
        return view('admin.Jefes')->with('users', $users)
                                ->with('types', $tiposboss)
                                ->with('areas', $arebossa)
                                ->with('elarray', $cleararray);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $users = User::all();
        $items = array();
        $userpivot = DB::table('type_user')->where('user_id', $id)->get();        

        return view('admin.areasjefes')->with('areas', $userpivot);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $boostochnge = User::find($id);
        $users = User::all();
        

        foreach ($user->types as $userboss) {
            $userjefe = $userboss;
        }            
        return view('admin.JefesEdit')->with('userjefe', $userjefe)
                                                ->with('users', $users)
                                                ->with('boostochnge', $boostochnge);
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
        //Actualizar los tipos de jefe y areas asignadas a un usuario especfico AREA JEFES
        $tipos = User::find($id);
        foreach ($request->areas as $area) {
            $tipos->types()->attach($area, [
                                        'id_areas' => $area,
                                        'type_id' => $request->tipojefe, 
                                        'user_id' => $request->usuario
                                    ]);
        }        

        $users = User::all();
        $tiposboss = Type::all();
        $arebossa = Area::all(); 
        $users = User::all();

        //obtener datos relacionados con tabla pivot COMO DEBE SER!!!!
        $arraydatos[] = 0;
        foreach($users as $user){
            $datos = App\User::find($user->id);
            foreach ($datos->types as $dato) {
                $datosid = $dato->pivot->pivotParent;
                $arraydatos[] = $datosid;            
            }
        }
        $elarray = array_unique($arraydatos);
        //limpiar el array le esta saliendo un item 0
        $cleararray = array_splice($elarray, 1);
        
        return view('admin.Jefes')->with('users', $users)
                                ->with('types', $tiposboss)
                                ->with('areas', $arebossa)
                                ->with('elarray', $cleararray);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //retornar a jefes 
        $users = User::all();
        $tiposboss = Type::all();
        $arebossa = Area::all(); 
        $users = User::all();
        
        //eliminar relacion de jefes
        $usuariob = User::find($id);
        
        foreach ($usuariob->types as $tiporel) {            
            $usuariob->types()->detach($tiporel->id);
        }
        
        //obtener datos relacionados con tabla pivot COMO DEBE SER!!!!
        $arraydatos[] = 0;
        foreach($users as $user){
            $datos = App\User::find($user->id);
            foreach ($datos->types as $dato) {
                $datosid = $dato->pivot->pivotParent;
                $arraydatos[] = $datosid;            
            }
        }
        $elarray = array_unique($arraydatos);
        //limpiar el array le esta saliendo un item 0
        $cleararray = array_splice($elarray, 1);
        
        return view('admin.Jefes')->with('users', $users)
                                ->with('types', $tiposboss)
                                ->with('areas', $arebossa)
                                ->with('elarray', $cleararray);
    }
}

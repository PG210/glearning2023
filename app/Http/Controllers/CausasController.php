<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CausasInvitaciones;


use Illuminate\Http\Request;
use App\Cause;
use App\User;
use App\Log;
use Auth;
use DB;

class CausasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $causas = Cause::all();        
        return view('player.causas')->with('causas', $causas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('player.CausasCreate');
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
        $useriosmatch = $request->userasignado;
        $userauthid = Auth::user()->id;
        $usernameauth = Auth::user()->firstname;

        $causa = new Cause;
        $causa->name = $request->name;
        $causa->description = $request->description;
        $causa->time = $request->time;
        $causa->save();

        //registro de LOGS
        Log::create([
            'model_name' => 'App\Cause',
            'recurso_id' => $causa->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'el usuario '.$usernameauth.' ha creado una Causa'
        ]);        

        $causa->users()->attach($useriosmatch, [
            'author_id' => $userauthid,
        ]);        
        
        //obtener causas
        $causas = DB::table('causes')->orderBy('created_at', 'desc')->first();
                
        //obtener autores de la causa
        $autores = DB::table('cause_user')->where('author_id', $userauthid)
                                            ->where('cause_id', $causas->id)
                                            ->orderBy('created_at', 'desc')->get();                                            
        
        foreach ($autores as $autor) {
            $jugador = User::find($autor->user_id); 
            $nombrejugador = $jugador->firstname . " " . $jugador->lastname;
            $contactlist = $jugador->email;   
            Mail::to($contactlist)->send( new CausasInvitaciones($nombrejugador, $causas->description) );
        }
        $causas = Cause::all();        
        return view('player.causas')->with('causas', $causas);           
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
    }
}

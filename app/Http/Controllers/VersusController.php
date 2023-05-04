<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\versusInvitaciones;
use Illuminate\Http\Request;
use App\Subchapter;
use App\Chapter;
use App\Challenge;
use App\User;
use Carbon\Carbon;
use DB;
use Auth;

class VersusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //lleva a la ventana VERSUS 
        //LISTA de versus 
        $userauthid = Auth::user()->id;
        $subchapteruser = DB::table('subchapter_user')->where('user_id', $userauthid)->get();        
        

        //
        return view('player.versus')->with('versus', $subchapteruser);
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


    public function pasarversus($id)
    {
        //obtiene el id del versus        
        $datos = array();
        $retos = Challenge::find($id);        
        $subchapter = Subchapter::find($retos->subchapter_id);
        foreach ($subchapter->users as $subchap) {
            $datos[] = $subchap;
        }
        return view('player.versusinvitar')->with('asignados', $datos)
                                            ->with('idreto', $id);
    }

    public function invitaciones(Request $request)
    {
        $playerone = Auth::user()->id;
        $idreto = $request->idreto;
        $playertwo = $request->userinvitado;
        
        DB::table('duels')->insert([
            'player1'      => $playerone,
            'player2'      => $playertwo,
            'challenge_id' => $idreto,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);
        
        $nombrejugador = User::find($playertwo);
            
         //objeto para enviar datos a la plantilla de correo
         $mailobjeto = new \stdClass();            
         $mailobjeto->nombrejugador = $nombrejugador->firstname;
         $mailobjeto->messagejefe = $request->messageinvitado;
         Mail::to($nombrejugador->email)->send( new versusInvitaciones($mailobjeto) );

        $subchapteruser = DB::table('subchapter_user')->where('user_id', $playerone)->get();        
        return view('player.versus')->with('versus', $subchapteruser);    
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

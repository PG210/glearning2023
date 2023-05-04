<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insignia;
use App\Log;
use App\User;
use DB;
use Auth;

class PopupsController extends Controller
{


    public function popupinsignia(Request $request, $id)
    {
        //========  Actualizar insignias del jugador  =======//
        $userauthid = Auth::user()->id;
        
        $insignias = Insignia::all();
        $insigniauser = User::find($userauthid);
        $insigniauser->s_point;
        $insigniauser->i_point;
        $insigniauser->g_point;

        //obtener y recorrer todas las insignias:
        foreach ($insignias as $insignia) {
            $insignia->id;
            $insignia->s_point;
            $insignia->i_point;
            $insignia->g_point;
            if ($insigniauser->i_point >= $insignia->i_point 
                        && $insigniauser->g_point >= $insignia->g_point 
                        && $insigniauser->i_point <= $insignia->i_point + 10
                        && $insigniauser->g_point <= $insignia->g_point + 10) {
                $woninsignias = 1;
                return response($woninsignias);
            }else {
                $woninsignias = 0;
                return response($woninsignias);
            }
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

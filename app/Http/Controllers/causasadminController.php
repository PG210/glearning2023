<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use DB;
use Auth;
use App\causapoint;

class causasadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $avaiblecausas = causapoint::all();        
        return view('admin.enablecauses')->with('avaiblecausas', $avaiblecausas);
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
        $avaiblecausas = causapoint::find($id);
        return view('admin.enablecausesEdit')->with('avaiblecausas', $avaiblecausas);
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

        //actualizar puntajes habilitar causas
        $enablecausa = causapoint::find($id);
        $enablecausa->i_point = $request->puntos_i;
        $enablecausa->g_point = $request->puntos_g;    
        $enablecausa->save();
       
        $avaiblecausas = causapoint::all();        
        return view('admin.enablecauses')->with('avaiblecausas', $avaiblecausas);        
        
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\User;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\alertaas;


class jefestiposController extends Controller
{
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
        $jefestipos = Type::all();
        return view('admin.jefestiposCreate')->with('jefestipos', $jefestipos);
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
        $jefestipos = Type::find($id);
        return view('admin.jefestiposEdit')->with('jefestipos', $jefestipos);

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
        //actualizar el jefe
        $typejefe = Type::find($id);
        $typejefe->name = $request->name;
        $typejefe->message = $request->message;
        $typejefe->g_point = $request->g_point;
        $typejefe->i_point = $request->i_point;
        $typejefe->save();

        $jefestipos = Type::all();
        return view('admin.jefestiposCreate')->with('jefestipos', $jefestipos);
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
        Type::destroy($id);
        $jefestipos = Type::all();
        return view('admin.jefestiposCreate')->with('jefestipos', $jefestipos);
    }
}

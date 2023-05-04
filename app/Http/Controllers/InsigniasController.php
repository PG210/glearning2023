<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insignia;
use App\Log;
use DB;
use Auth;


class InsigniasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status="";
        $insignias = Insignia::all();        
        return view('admin.insignias')->with('insignias', $insignias)
                                        ->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.InsigniasCreate');
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
            'name' => 'required|unique:insignias|max:255',
            'imagen' => 'required',
            'spoints' => 'required',
            'ipoints' => 'required',
            'gpoints' => 'required',
            'descripcion' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre para la insignia',
            'name.unique' => 'Esta Insignia ya existe',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'imagen' => 'Inserta una medalla', 
            'spoints.required' => 'Ingresa un Puntaje S para continuar',
            'ipoints.required' => 'Ingresa un Puntaje I para continuar',
            'gpoints.required' => 'Ingresa un Puntaje G para continuar',
            'descripcion.required' => 'Ingresa una descripcion para la Insignia',
        ];         
        $this->validate($request, $rules, $messages);

        $status="";
        $userauthid = Auth::user()->id;

        //obtener y guardar el archivo imagen (debe crearse un link a la carpeta storage=>public con php artisan storage:link)
        
        //proceso guardar imagen de la insignia
        if ($request->hasFile('imagen')) {            
            $thefilename = $request->file('imagen')->getClientOriginalName();
            $pathfile = 'storage/'.$thefilename;
            $request->file('imagen')->storeAs('/', $thefilename);
        }else {
            $pathfile ="storage/default.png";
        }
        
        $insignias = new Insignia;

        $insignias->name = $request->name;
        $insignias->imagen = $pathfile;
        $insignias->s_point = $request->spoints;
        $insignias->i_point = $request->ipoints;
        $insignias->g_point = $request->gpoints;
        $insignias->description = $request->descripcion;
        $insignias->save();

        //registro de LOGS
        Log::create([
            'model_name' => 'App\Insignia',
            'recurso_id' => $insignias->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'Una Insignia ha sido Creada'
        ]);

        $insignia = Insignia::all();        
        return view('admin.insignias')->with('insignias', $insignia)
                                    ->with('status', $status);
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
        $insignias = Insignia::find($id);
        return view('admin.insigniasEdit')->with('insignias', $insignias);
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
        $status="";
        //obtener y guardar el archivo imagen (debe crearse un link a la carpeta storage=>public con php artisan storage:link)
        
        //proceso guardar imagen de la insignia
        // if ($request->hasFile('imagen')) {            
        //     $thefilename = $request->file('imagen')->getClientOriginalName();
        //     $pathfile = 'storage/'.$thefilename;
        //     $request->file('imagen')->storeAs('public', $thefilename);
        // }else {
        //     $pathfile ="storage/default.png";
        // }
        
        $insignias = Insignia::find($id);

        $insignias->name = $request->name;
        // $insignias->imagen = $pathfile;
        $insignias->s_point = $request->spoints;
        $insignias->i_point = $request->ipoints;
        $insignias->g_point = $request->gpoints;
        $insignias->description = $request->descripcion;
        $insignias->save();

        $insignia = Insignia::all();        
        return view('admin.insignias')->with('insignias', $insignia)
                                    ->with('status', $status);                                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insignias = Insignia::find($id);
        
        $status="";
        $count=0;
        
        $count+=count($insignias->users);
        
        if ($count>0) {
            $status = 'Insignia esta relacionada, Imposible eliminar';
        } else {
            Insignia::destroy($id);
            $status = 'Insignia Eliminada correctamente';
        }

        $insignia = Insignia::all();        
        return view('admin.insignias')->with('insignias', $insignia)
                                        ->with('status', $status);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subchapter;
use App\Chapter;
use App\Challenge;
use App\Challenge_Type;
use App\Quiz;
use App\Log;
use DB;
use Auth;

class RetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tiposreto = Challenge_Type::all();        
        return response()->json($tiposreto);
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

    public function pasarsubcapitulo($id)
    {
        return view('admin.retosCreate')->with('subcapitulo', $id);
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
            'name' => 'required|unique:challenges|max:255',
            'description' => 'required',
            'time' => 'required',
            'i_pts' => 'required',
            'g_pts' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre para el RETO',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'name.unique' => 'Este Reto ya existe',
            'description.required' => 'Ingresa una descripcion para el reto',
            'time.required' => 'Ingresa un tiempo para la realizacion del reto',
            'i_pts.required' => 'Ingresa un puntaje tipo I',
            'g_pts.required' => 'Ingresa un puntaje tipo G',
        ];         
        $this->validate($request, $rules, $messages);

        //proceso guardar archivo material para el reto
        if($request->hasFile('material')){            
            $thefilename = $request->file('material')->getClientOriginalName();
            $pathmaterial = 'http://127.0.0.1:8000/storage/'.$thefilename;
            //http://evolucion.website/storage/
            $request->file('material')->storeAs('public', $thefilename);
        }else {
            $pathmaterial = "";            
        }

        //AHORCADO
        if(!$request->dificultad){
            $dificultadreto = 0;
        } else{
            $dificultadreto = $request->dificultad;
        }
        
        $userauthid = Auth::user()->id;

        $retos = new Challenge;
        $retos->name = $request->name;
        $retos->time = $request->time;
        $retos->dificult = $dificultadreto;
        $retos->description = $request->description;
        $retos->i_point = $request->i_pts;
        $retos->g_point = $request->g_pts;
        $retos->gametype = $request->gametype;
        $retos->material = $pathmaterial;
        $retos->challenge_type_id = $request->challenge_type_id;        
        $retos->subchapter_id = $request->subchapter_id; 
        
        $retos->urlvideo = $request->urlvideo;
        
        //AHORCADO
        if($request->ahorcado){
            $retos->params = $request->ahorcado;
        }
        //SOPA DE LETRAS
        if($request->sopaletras){
            $retos->params = json_encode($request->sopaletras);
        }
        $retos->save();

        //registro de LOGS
        Log::create([
            'model_name' => 'App\Challenge',
            'recurso_id' => $retos->id,
            'user_id' => $userauthid,
            'accion_realizada' => 'un Reto ha sido Creado'
        ]);
                
        //QUICES
        if($request->encuestaelegida){
            $retos->quizzes()->sync($request->encuestaelegida);
        }

        $status="";
        //volver a la ruta de los retos listados
        $subcapitulos = Subchapter::find($request->subchapter_id);
        return view('admin.retos')->with('subcapitulos', $subcapitulos)
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
        $status="";
        $subcapitulos = Subchapter::find($id);
        return view('admin.retos')->with('subcapitulos', $subcapitulos)
                                                ->with('status', $status);                                                
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
        $retos = Challenge::find($id);
        $subcapitulos = Subchapter::find($retos->subchapter_id);

        //consultar categorias y nivel
        $cat = DB::table('caterecompensas')->get();
        $niv = DB::table('nivelcate')->get();

        return view('admin.RetosEdit')->with('retos', $retos)
                                    ->with('subcapitulo', $subcapitulos->name)
                                    ->with('cat', $cat)
                                    ->with('niv', $niv);
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
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'time' => 'required',
            'i_pts' => 'required',
            'g_pts' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre para el RETO',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'description.required' => 'Ingresa una descripcion para el reto',
            'time.required' => 'Ingresa un tiempo para la realizacion del reto',
            'i_pts.required' => 'Ingresa un puntaje tipo I',
            'g_pts.required' => 'Ingresa un puntaje tipo G',
        ];         
        $this->validate($request, $rules, $messages);

        //proceso guardar archivo material para el reto
        if($request->hasFile('material')){            
            $thefilename = $request->file('material')->getClientOriginalName();
            $pathmaterial = 'http://127.0.0.1:8000/storage/'.$thefilename;
            //http://evolucion.website/storage/
            $request->file('material')->storeAs('public', $thefilename);
        }else {
            $pathmaterial = "";            
        }

        //##########################
        $insig = DB::table('insignias')->where('id_nivel', $request->nivel)->where('id_cate', $request->cate)->first();
        //####################
       // return $insig->id;
        $retos = Challenge::find($id);
        $retos->name = $request->name;
        $retos->time = $request->time;
        $retos->description = $request->description;
        $retos->i_point = $request->i_pts;
        $retos->g_point = $request->g_pts;
        $retos->gametype = $request->gametype;
        $retos->material = $pathmaterial;
        $retos->challenge_type_id = $request->challenge_type_id;        
        $retos->subchapter_id = $request->subchapter_id; 
        $retos->id_insignia = $insig->id; //se agrego este item
        $retos->urlvideo = $request->urlvideo;
        
        //AHORCADO
        if($request->ahorcado){
            $retos->params = $request->ahorcado;
        }
        //SOPA DE LETRAS
        if($request->sopaletras){
            $retos->params = json_encode($request->sopaletras);
        }
        $retos->save();
        
        //QUICES
        if($request->encuestaelegida){
            $retos->quizzes()->sync($request->encuestaelegida);
        }

        $status="";
        //volver a la ruta de los retos listados
        $subcapitulos = Subchapter::find($request->subchapter_id);
        return view('admin.retos')->with('subcapitulos', $subcapitulos)
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
        //
        $retos = Challenge::find($id);        
        $status="";
        $countquizzes=0;
        $countusersretos=0;
        
        $countquizzes+=count($retos->quizzes);
        $countusersretos+=count($retos->users);
        
        if ($countquizzes>0 || $countusersretos > 0) {
            $status = 'Este Reto esta relacionado con juegos en progreso, Imposible eliminar';
        } else {
            Challenge::destroy($id);
            $status = 'Eliminado correctamente';
        }
        
        // $subcapitulos = Subchapter::find($id);
        // return view('admin.retos')->with('subcapitulos', $subcapitulos)
        //                                 ->with('status', $status);

        return redirect()->back();
    }

    public function datosreto($id)
    {
        
        $retos = Challenge::find($id);     
        $tiporeto = DB::table('challenge_types')->where('id', $retos->challenge_type_id)->get(); 
        return view('admin.viewChallenge')->with('retos', $retos)->with('tiporeto', $tiporeto);
    }
}
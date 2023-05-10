<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;
use App\Subchapter;
use App\PosUsuModel\SubcapUser;
use DB;
use Auth;

class CapitulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status = "";
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)->with('status', $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.CapitulosCreate');
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
        $status = "";
        $capitulo = new Chapter;
        $capitulo->name = $request->name;
        $capitulo->title = $request->title;
        $capitulo->order = $request->order;
        $capitulo->time = $request->time;
        $capitulo->description = $request->description;

        $capitulo->save();
        
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        // ====================== PUNTAJES S EN CAPITULOS vs SUBCAPITULOS ==========================
        //cantidad puntos maximos de un capitulo
        $chapter = 100;
        $user = Auth::user()->id;
        //cantidad de subcapitulos en el capitulo actual
        $subchapters = DB::table('subchapters')->where('chapter_id', $id)->count();
        //******************************************* */
        //evaluar si el capitulo esta terminado
         // return $verif;
           $subcap = DB::table('subchapters')->where('chapter_id', $id)->select('subchapters.id as idchap')->get();

            $tareas = array(); // Initialize the $tareas array to avoid errors
            foreach ($subcap as $sub) {
                $tasks = DB::table('challenges')->where('subchapter_id', $sub->idchap)->select('id')->get(); 
                // Use ->id instead of ->idtarea to select the task ID
                $tareas = array_merge($tareas, $tasks->toArray()); // Merge the task IDs into the $tareas array
            }
            // Verify that the user has completed all tasks in the $tareas array 
            foreach ($tareas as $tarea) {
                $verif = DB::table('challenge_user')->where('user_id', $user)->where('challenge_id', $tarea->id)->count();
                if ($verif == 0) {
                    // If the user has not completed a task, return false
                    $tem = 1;
                }else{
                    $tem = 0;
                }
            }
            //return $tem;
            // If the loop completes without returning false, the user has completed all tasks
           // $tem = 0;

        //******************************************* */
       /*evaluar si tiene subcapitulos pendientes*/
        
        //cantidad puntos para subcapitulos
        $points = $chapter / $subchapters;

        //asignar y actualizar puntos a cada subcapitulo del capitulo elegido
        $updatepts = Subchapter::where('chapter_id', $id)->update(['s_point' => $points]);

        //volver a la vista presentando los subcapitulos del capitulo
        $conta = DB::table('subchapter_user')
                   ->where('user_id', '=', $user)
                   ->select('chapter_id')
                   ->distinct('chapter_id')
                   ->count();
        if($conta != 0){
            $usercap = DB::table('subchapter_user')
                   ->where('user_id', '=', $user)
                   ->where('estado', '=', 0)
                   ->select('chapter_id', 'id', 'estado')
                   ->distinct('chapter_id')
                   ->orderBy('chapter_id','ASC')
                   ->get();
            if(isset($usercap[0]->chapter_id)){
            if($usercap[0]->estado == 0){ //aqui avanza  los capitulos pero se debe validar el total de completados 
                $capitulos = Chapter::find($usercap[0]->chapter_id);
                 //cantidad de subcapitulos en el capitulo actual
                $consub = DB::table('subchapters')->where('chapter_id', $usercap[0]->chapter_id)->count();
                $cat = SubcapUser::find($usercap[0]->id);
                $cat->estado = 1;
                $cat->save();
                $mensaje = 0;
            }
          }else{
            $capitulos = Chapter::find($id);
            $mensaje = 1;
          }
        }else{
            $capitulos = Chapter::find($id);
            $mensaje = 0;
        }
        //$capitulos = Chapter::find($id);
        //subchapter user 

       // return $usercap[0]->chapter_id;


        return view('player.capitulos')->with('capitulos', $capitulos)->with('mensaje', $mensaje)->with('tem', $tem);
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
        $capitulos = Chapter::find($id);
        //return $capitulos;
        return view('admin.CapitulosEdit')->with('capitulos', $capitulos);
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
        $rules = [
            'name' => 'required|unique:challenges|max:255',            
            'desc' => 'required',
            'title' => 'required',
            'order' => 'required',
        ];         
        $messages = [
            'name.required' => 'Debes ingresar un Nombre de Area',
            'name.max' => 'El Nombre no puede exceder la cantidad de 255 caracteres',
            'name.unique' => 'Esta Area ya existe',
            'desc.required' => 'Ingresa una descripcion',
            'title.required' => 'Ingresa un titulo',
            'order.required' => 'Ingresa orden',
        ];         
        $this->validate($request, $rules, $messages);


        $status = "";
        $capitulo = Chapter::find($id);
        $capitulo->name = $request->name;
        $capitulo->title = $request->title;
        $capitulo->order = $request->order;
        // $capitulo->time = $request->time;
        $capitulo->description = $request->desc;
        //guardar video 
        $capitulo->videoIntro = $request->video;
        $capitulo->save();

        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)
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
        $capitulos = DB::table('subchapters')->where('chapter_id', $id)->get();

        $status="";
        $count=0;        
        $count+=count($capitulos->subchapters);
        
        if ($count>0) {
            $status = 'Capitulo esta relacionado con subcapitulos, Imposible eliminar';
        } else {
            Chapter::destroy($id);
            $status = 'Eliminado correctamente';
        }
        $capitulos = Chapter::all();        
        return view('admin.capitulos')->with('capitulos', $capitulos)
                                        ->with('status', $status);

    }
}

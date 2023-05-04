<?php

namespace App\Http\Controllers;
use DB;
use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userauthid = Auth::user()->id;

        $competencia_usuario = DB::table('users')
                                ->select(DB::raw('MAX(competences.name) as competencia'),
                                        DB::raw('MAX(subchapter_user.chapter_id) as max_chapter'),
                                        DB::raw('MAX(subchapter_user.subchapter_id) as max_subchapter'))
                                ->join('subchapter_user', 'users.id', '=', 'subchapter_user.user_id' )
                                ->join('subchapters', 'subchapter_user.subchapter_id', '=', 'subchapters.id')
                                ->join('competences', 'subchapters.competence_id', '=', 'competences.id')
                                ->where('users.id', '=', $userauthid)
                                ->first();

        return view('home')
                ->with('competencia_usuario', $competencia_usuario);
    }
}

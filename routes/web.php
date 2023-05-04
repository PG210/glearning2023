<?php

use App\Http\Controllers\Carga\SubirArchivoController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\RegController\RegunicoController;
use App\Http\Controllers\ReportcompletosController;
use App\Http\Controllers\Carga\GruposController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//perfil cuando ingresa el usuario
Route::get('/home/perfil', [PerfilController::class, 'index'])->name('perfilhome')->middleware('redirectIfSessionExpired');

//actualizar usuario datos al controlador
Route::post('/actualizar/usuario/{id}', [PerfilController::class, 'actu'])->name('actualizarusu');



Route::get('/historia', function () {
    return view('historia');
})->middleware('auth');

Route::get('/playerchapters', 'PlayerChaptersController@index')->middleware('auth');
Route::resource('playerchapters', 'PlayerChaptersController')->middleware('auth');
Route::resource('startchallenges', 'PlayerChallengeController')->middleware('auth');


Route::get('/playerchapter/{id}', ['uses' =>'PlayerChaptersController@pasarchapter', 'as'=>'profile.pasarchapter'])->middleware('auth');
Route::get('/playerchallenge/{id}', ['uses' =>'PlayerChaptersController@pasarchallenge', 'as'=>'profile.pasarchallenge'])->middleware('auth');


//pasarle id reto a la pantalla de retos en el player
Route::get('/challenge/{id}', ['uses' =>'PlayerChallengeController@challenge', 'as'=>'player.challenge'])->middleware('auth');

//comenzar el juego test encuestas
Route::get('/startchallenge/{id}', ['uses' =>'PlayerChallengeController@startplay', 'as'=>'player.startchallenge'])->middleware('auth');

Route::get('/startchallenge', function () {
    return view('player.startchallenge');
})->middleware('auth');
Route::get('/playerCapitulos', function () {
    return view('player.capitulos');
})->middleware('auth');
Route::get('/grupos', function () {
    return view('player.grupos');
})->middleware('auth');
Route::get('/finishquiz', function () {
    return view('player.finishquiz');
})->middleware('auth');
Route::get('/insignias', function () {
    return view('player.insignias');
})->middleware('auth');
Route::get('/perfil', function () {
    return view('player.perfil');
})->middleware('auth');
Route::get('/recompensas', function () {
    return view('player.recompensas');
})->middleware('auth');
Route::get('/reconocimientos', function () {
    return view('player.recompensas');
})->middleware('auth');
Route::get('/retosUser', function () {
    return view('player.retos');
})->middleware('auth');

//Route::get('/subcapitulos/{id}', 'SubcapituloController@pasardatos');
//Route::get('/editindustry/{id}', 'SubcapituloController@create');

Route::get('/subcaps/{id}', ['uses' =>'SubcapituloController@pasarcapitulo', 'as'=>'subcapitulos.pasarcapitulo'])->middleware('auth');
Route::get('/challenges/{id}', ['uses' =>'RetosController@pasarsubcapitulo', 'as'=>'retos.pasarsubcapitulo'])->middleware('auth');
Route::get('/verretos/{id}', ['uses' =>'RetosController@datosreto', 'as'=>'retos.datosreto'])->middleware('auth');

Route::get('/areasregistro', 'AreaController@areasregistro');
Route::get('/positionsregistro/{id}', ['uses' =>'AreaController@positionsregistro', 'as'=>'retos.positionsregistro']);


Route::get('/quizzesupdate/{id}', ['uses' =>'QuizController@quizzesupdate', 'as'=>'retos.quizzesupdate']);
Route::get('/quizzesquestionsupdate/{id}', ['uses' =>'QuizController@quizzesquestionsupdate', 'as'=>'retos.quizzesquestionsupdate']);
Route::get('/quizzesquestionanswerssupdate/{id}', ['uses' =>'QuizController@quizzesquestionanswerssupdate', 'as'=>'retos.quizzesquestionanswerssupdate']);


Route::get('/usuario', 'UserController@index');
Route::resource('usuario', 'UserController');

Route::get('/insignias', 'InsigniasController@index')->middleware('auth');
Route::resource('insignias', 'InsigniasController')->middleware('auth');

Route::get('/reportcompletos', 'ReportcompletosController@index')->middleware('auth');
Route::resource('reportcompletos', 'ReportcompletosController')->middleware('auth');
Route::post('/reportcompletosinfo/{id}', ['uses' =>'ReportcompletosController@more', 'as'=>'reportcompletos.more'])->middleware('auth');

Route::get('/reportjugados', 'ReportjugadosController@index')->middleware('auth');
Route::resource('reportjugados', 'ReportjugadosController')->middleware('auth');
Route::get('/reportjugadosinfo/{id}', ['uses' =>'ReportjugadosController@more', 'as'=>'reportjugados.more'])->middleware('auth');


Route::get('/competencias', 'CompetenciasController@index')->middleware('auth');
Route::resource('competencias', 'CompetenciasController')->middleware('auth');

Route::get('/reconocimientos', 'AwardController@index')->middleware('auth');
Route::resource('reconocimientos', 'AwardController')->middleware('auth');

Route::get('/causas', 'CausasController@index')->middleware('auth');
Route::resource('causas', 'CausasController')->middleware('auth');

Route::get('/causasadmin', 'causasadminController@index')->middleware('auth');
Route::resource('causasadmin', 'causasadminController')->middleware('auth');

Route::get('/quizzes', 'QuizController@index')->middleware('auth');
Route::resource('quizzes', 'QuizController')->middleware('auth');

Route::get('/quizzesdisponible', 'QuizAvailableController@index')->middleware('auth');
Route::resource('quizzesdisponible', 'QuizAvailableController')->middleware('auth');

Route::get('/capitulos', 'CapitulosController@index')->middleware('auth');
Route::resource('capitulos', 'CapitulosController')->middleware('auth');

Route::get('/subcapitulos', 'SubcapituloController@index')->middleware('auth');
Route::resource('subcapitulos', 'SubcapituloController')->middleware('auth');

Route::get('/retos', 'RetosController@index')->middleware('auth');
Route::resource('retos', 'RetosController')->middleware('auth');

Route::middleware(['auth', 'adminsgo'])->group(function () {

    Route::get('/backdoor', function () {
        return view('admin.dashboard');
    })->middleware('auth');

    Route::get('/jefes', 'JefeController@index')->middleware('auth');
    Route::resource('jefes', 'JefeController')->middleware('auth');

    Route::get('/jefesareas', 'jefesAreasController@index')->middleware('auth');
    Route::resource('jefesareas', 'jefesAreasController')->middleware('auth');

    Route::get('/jefestipos', 'jefestiposController@index')->middleware('auth');
    Route::resource('jefestipos', 'jefestiposController')->middleware('auth');


    Route::get('/cargos', 'CargoController@index')->middleware('auth');
    Route::resource('cargos', 'CargoController')->middleware('auth');

    Route::get('/areas', 'AreaController@index')->middleware('auth');
    Route::resource('areas', 'AreaController')->middleware('auth');

    //carga masiva
    Route::get('/carga/users', function () {
        return view('admin.carga');
    })->name('cargamasiva')->middleware('auth');

});


Route::get('/versus/{id}', ['uses' =>'VersusController@pasarversus', 'as'=>'versus.pasarversus'])->middleware('auth');
Route::post('/versusinvitar', ['uses' =>'VersusController@invitaciones', 'as'=>'versus.invitaciones'])->middleware('auth');

Route::get('/versus', 'VersusController@index')->middleware('auth');
Route::resource('versus', 'VersusController')->middleware('auth');

Route::get('/about', function () {
    return view('acerca_de_evolucion');
})->middleware('auth');

Route::get('/faq', function () {
    return view('faq');
})->middleware('auth');



// =========== juegos unity ===========
Route::get('/gameahorcado', function () {
    return view('games.ahorcado');
})->name('games.ahorcado')->middleware('auth');

Route::get('/gamerompecabeza', function () {
    return view('games.rompecabezas');
})->name('games.rompecabezas')->middleware('auth');

Route::get('/gamesopaletra', function () {
    return view('games.sopaletras');
})->name('games.sopaletras')->middleware('auth');




// =========== Juegos Casuales ==============
Route::get('/ahorcado/{id}', ['uses' =>'GamesController@ahorcado', 'as'=>'games.ahorcado'])->middleware('auth');
Route::get('/sopaletras/{id}', ['uses' =>'GamesController@sopaletras', 'as'=>'games.sopaletras'])->middleware('auth');
Route::get('/rompecabezas/{id}', ['uses' =>'GamesController@rompecabezas', 'as'=>'games.rompecabezas'])->middleware('auth');
Route::get('/seevideos/{id}', ['uses' =>'GamesController@seevideos', 'as'=>'games.seevideos'])->middleware('auth');
Route::get('/upfotos/{id}', ['uses' =>'GamesController@upfotos', 'as'=>'games.upfotos'])->middleware('auth');
Route::get('/lectura/{id}', ['uses' =>'GamesController@lectura', 'as'=>'games.lectura'])->middleware('auth');
Route::get('/outdoor/{id}', ['uses' =>'GamesController@outdoor', 'as'=>'games.outdoor'])->middleware('auth');


//funciones guardado resultado
Route::post('/unitygamesplayed/{id}', ['uses' =>'GamesController@unitygamesplayed', 'as'=>'gamesplay.unitygamesplayed'])->middleware('auth');
Route::post('/playseevideos/{id}', ['uses' =>'GamesController@playseevideos', 'as'=>'gamesplay.seevideos'])->middleware('auth');
Route::post('/playupfotos/{id}', ['uses' =>'GamesController@playupfotos', 'as'=>'gamesplay.upfotos'])->middleware('auth');
Route::post('/playlectura/{id}', ['uses' =>'GamesController@playlectura', 'as'=>'gamesplay.lectura'])->middleware('auth');
Route::post('/playoutdoor/{id}', ['uses' =>'GamesController@playoutdoor', 'as'=>'gamesplay.outdoor'])->middleware('auth');


//funciones VUEJS para popups
Route::get('/popupinsignia', 'PopupsController@index')->middleware('auth');
Route::resource('popupinsignia', 'PopupsController')->middleware('auth');
Route::get('/popupinsignias/{id}', ['uses' =>'PopupsController@popupinsignia', 'as'=>'popupinsignias.popupi'])->middleware('auth');


Route::resource('gamescontroller', 'GamesController')->middleware('auth');

//Game OVER
Route::get('/gameover', function () {
    return view('player.gameover');
})->middleware('auth')->middleware('auth');

//ruta subir carga masiva

Route::post('/subir', [SubirArchivoController::class, 'index'])->name('subir');
Route::get('/carga/usu/masiva', [SubirArchivoController::class, 'cargar'])->name('crg');
Route::get('/carga/usu/registro/{file}', [SubirArchivoController::class, 'registrar'])->name('carga_usu');
Route::get('/carga/usu/eliminar/{file}', [SubirArchivoController::class, 'eliminar'])->name('eliminar_arch');

//egistro de usuario
Route::get('/admin/registro/unico', [RegunicoController::class, 'index'])->name('usureg_admin')->middleware('auth');
Route::post('/admin/reg/usu', [RegunicoController::class, 'regunico'])->name('regunicousuario')->middleware('auth');

//grupos
Route::get('/admin/vista/grupos', [GruposController::class, 'index'])->name('gruposvis')->middleware('auth');
Route::post('/admin/reg/grupos', [GruposController::class, 'reg'])->name('guardargrupo')->middleware('auth');
Route::post('/admin/actu/grupos/{id}', [GruposController::class, 'actu'])->name('actualizargrupo')->middleware('auth');
Route::get('/admin/eliminar/grupos/{id}', [GruposController::class, 'eliminar'])->name('gruposelim')->middleware('auth');
Route::get('/admin/usuarios/grupos', [GruposController::class, 'usuarios'])->name('usuariosgrupos')->middleware('auth');
Route::post('/admin/vincular/grupo/usu', [GruposController::class, 'vingrupo'])->name('vingrupo')->middleware('auth');
Route::get('/admin/capitulos/grupos/{id}', [GruposController::class, 'vincap'])->name('vincap')->middleware('auth');
Route::get('/admin/capitulos/vin/usu/{id}/{id1}', [GruposController::class, 'vinculocap'])->middleware('auth');
Route::get('/admin/capitulos/eliminar/usu/{id}/{id1}', [GruposController::class, 'eliminarvincap'])->middleware('auth');

//end grupos
Route::get('/reportcompletos/info/retos/hola', [ReportcompletosController::class, 'crearchi'])->name('creartxt');
//ruta para buscar usuarios
Route::post('/admin/buscar/user', [GruposController::class, 'buscarusu'])->name('buscar_usuario')->middleware('auth');

//actualizar perfil desde el admin
Route::get('/home/perfil/admin/{id}', [PerfilController::class, 'actuadmin'])->middleware('redirectIfSessionExpired');

//ctualizar usuario
Route::post('/home/perfil/usu/admin/{id}', [PerfilController::class, 'actualizarusuadmin'])->name('actualizarusuadmin')->middleware('redirectIfSessionExpired');


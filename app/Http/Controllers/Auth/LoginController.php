<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
Use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected function authenticated($request, $user){
        if($user->estado != 0){
        if ($user->admin == 1) {
            return redirect('/backdoor');
        } else {
            if($user->admin == 2){
                return redirect('/admin');
            }else{
                return redirect('/home');
            }
        }
      }else{
        Auth::logout();
        Session::flash('errorInicio','Lo sentimos! Tu usuario ha sido deshabilitado');
        return redirect('/login');
      }
    }
     //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'username';
    }

    //funcion 30/03/22
    public function email(){
        return 'email';
    }
}

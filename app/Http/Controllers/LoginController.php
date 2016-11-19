<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PlanificaMYPE\Http\Requests;
use Illuminate\Support\Facades\Hash;

use PlanificaMYPE\Http\Requests\LoginRequest;
use PlanificaMYPE\Usuario;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginController extends Controller
{
	public function index (){
        
		return view('login.index');  
	}
	
    /*
    public function autenticar(LoginRequest $request){

    	$usuario = $request->get('usuario');
    	$contrasenia =  $request->get('contrasenia') ;

        $usuario = Usuario::where('usuario','=',$usuario)->first();
        
        if ($usuario ==null ){
            return redirect()->action('LoginController@index' )->withInput()->withErrors ('Usuario inválido'); 
        }

        else {
            $resultado= Hash::check( $contrasenia, $usuario->contrasenia);
            if ($resultado){
                
                Auth::login($usuario);

                return redirect()->action('ClienteController@index' );

            }
            else{
                return redirect()->action('LoginController@index' )->withInput()->withErrors ('Contraseña incorrecta'); 
            }
        }        

    }*/

    
    public function autenticar(LoginRequest $request){

        $usuario = $request->get('usuario');
        $contrasenia =  $request->get('contrasenia') ;

        if (Auth::attempt(['usuario' => $usuario, 'password' => $contrasenia])) {
            return redirect()->action('ClienteController@index' );
        }
        return redirect()->action('LoginController@index' )->withInput()->withErrors ('Usuario o contraseña incorrecto');  

    }

    public function logout (){
        Auth::logout();
        return redirect()->action('LoginController@index' );  
    }


}

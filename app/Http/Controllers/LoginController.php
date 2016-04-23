<?php

namespace App\Http\Controllers;

use App\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
{
	public function showLogin()
	{
		//Verificamos si hay sesión activa
		if(Auth::check())
		{
			//Si tenemos sesión activa mostrará la página de inicio
			return Redirect::to('/');
		}

		//Si no hay sesión activa se muestra el formulario
		return View::make('login');
	}

	public function postLogin(Request $request, $idUser)
	{
		//Se Busca al usuario en la base de datos
		$usuario = App\Models\Users::find($idUser)
		//Se compara con los datos obtenidos del formulario
		if($usuario->username == $request->username)
		{
			return "Los nomobres coinciden";
		}

		return response()-json([
				"msg"=>"success",
				"usuario"=>$usuario
			])

		//Se verifican los datos
		/*
		 *Como segundo parámetro pasamos el checkbox 
		 *para saber si queremos recordar la contraseña
		*/
		if(Auth::attempt($data,Input::get('remember')))
		{
			//Si los datos son correctos se muestra la página de inicio
			return Redirect::intended('/');
		}
		//Si los datos son incorrectos se vuelve al Login y se muestra un error
		return Redirect::back()->with('error_message','Invalid data')->withInput();
	}

	public function logOut()
	{
		//Cerramos la sesión
		Auth::logout();
		//Se vuelve al login y se muestra un mensaje indicando que se cerró la sesión
		return Redirect::to('login')->with('error_message','Logged out correctly');
	}

	public function muestraLogin()
	{

	}
}
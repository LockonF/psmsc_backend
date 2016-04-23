<?php

namespace App\Http\Controllers;

use App\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
{
	public function validarUsuario(Request $request, $idUser)
	{
		$usuario =App\Models\Usuarios::find($idUser);
		if($usuario->username == $request->username)
		{
			return "Los nombres coinciden";
		}
	}
}
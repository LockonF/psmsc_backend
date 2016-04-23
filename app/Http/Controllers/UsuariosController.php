<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    public function index()
    {
    
        /*$users = User::all();
        return $users;*/
    
    $users = Usuarios::all();

    	return response()->json([
    			"usuarios"=> $users
    	       ],200
    	);
    }

    public function show($idUser)
    {
        $user = \App\Models\Usuarios::find($idUser);
        return response()->json([
                "msg"=> "success",
                "user"=> $user
               ],200
        );
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function store(Request $request)
    {   
        $user = new \App\Models\Usuarios();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->Rpassword = $request->Rpassword;
        $user->email = $request->email;
        $user->FechaNac = $request->FechaNac;
        $user->save();

        return response()->json([
                "msg"=> "success",
                "Usuario creado: "=> $user->username
               ],200
        );
    }

    public function update(Request $request, $idUser)
    {
        $user = \App\Models\Usuarios::find($idUser);
        $user->username = $request->username;
        $user->password = $request->password;
        $user->Rpassword = $request->Rpassword;
        $user->save();

        return response()->json([
                "msg"=> "success"
               ],200
        );
    }

    public function destroy()
    {
        $user = \App\Models\Usuarios::find($idUser);
        $user->delete();

        return response()->json([
                "msg"=> "success"
               ],200
        );
    }


}

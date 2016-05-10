<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Storage;

class AuthenticateController extends Controller
{



    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if($credentials['email'] =='' or $credentials['password']=='')
        {
            return response()->json(['error' => 'Usuario o Contraseña Incorrectas'], 401);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        //\Storage::disk('local')->put('token','token');
        // all good so return the token
        return response()->json([
            "msg" => "Success",
            compact('token')]);
    }

    /*protected function validator(Request $request)
    {
        return Validator::make($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }*/

    public static function checkUser($privilege='User')
    {
        $admin = ['Admin'];
        $userPermissions = ['Admin','User'];
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                throw new Exceptions\JWTException;
            }
            return $user;
        } catch (Exceptions\TokenExpiredException $e) {
            throw $e;
        } catch (Exceptions\TokenInvalidException $e) {
            throw $e;
        } catch (Exceptions\JWTException $e) {
            throw $e;
        }
    }


    public function create(Request $request)
    {

        /*$rules = array(
            'username' => 'required',
            'password' => 'required', 
            'password_confirmation' => 'required',
            'email' => 'required', 
            'FechaNac' => 'required'
            );

        $this->validate($request, $rules);
        /*$validate=Validator::make($request,[
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|min:6|confirmed',
          ]);*/
        /*return User::create([
            'username' => $request['name'],
            'email' => $request['email'],
            'FechaNac' => $request['FechaNac'],
            'password' => Hash::make($request['password'])
            ]);*/
        $user = User::where('email',$request->email)->first();
        if($user == null)
        {
            $validator = Validator::make($request->all(),
            [
                'email'=>'required|unique:usuarios,email|email',
                'password'=>'required|same:password_confirm|min:6',
                'password_confirm'=>'required',
                //'FechaNac'=>'required|date',
                'username'=>'required'
            ]);
            if($validator->fails())
                return response()->json($validator->errors(),422);

            $user = new \App\User();
            $user->username = $request->username;
            $user->password = Hash::make($request ['password']);
            $user->email = $request->email;
            $user->FechaNac = $request->FechaNac;
            try{
                $user->save();
                $directory = '/Usuarios/'.$request->email;
                Storage::makeDirectory($directory);
                return response()->json(['msg'=>'success'],200);
            }catch (QueryException $e)
            {
                return response()->json(['msg'=>'save_error'],500);
            }
        }
        else
            return response()->json(['msg'=>'user_already_exists'],500);

    }//fin de create
}

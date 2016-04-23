<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Publicaciones;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class PublicacionesController extends Controller
{

    private $validaciones = [
        'nombre' => 'required',
        'precio' => 'required|numeric',
    ];


    public function index(Requests $request)
    {

        $Publicaciones = \App\Models\Publicaciones::get();
        //$Publicaciones = Publicaciones::paginate(10);
        //$Publicaciones = Publicaciones::nombre($request->get('nombre'));
        //$Publicaciones = Publicaciones::Search($request->nombre);
        return response()->json([
            "msg" => "success",
            "Publicaciones" => $Publicaciones->toArray()
        ], 200
        );
    }

    public function show($idPublication)
    {
        $Publication = \App\Models\Publicaciones::find($idPublication);
        return response()->json([
            "msg" => "success",
            "Publicación" => $Publication
        ], 200
        );
    }


    public function showByUsuario()
    {
        $user = AuthenticateController::checkUser();
        $publicacions = $user->Publicaciones()->get();
        return response()->json(['publicaciones' => $publicacions]);

    }


    public function store(Request $request)
    {
        try {
            $user = AuthenticateController::checkUser();

            //proceso para guardar la imagen
            if ($request->hasFile('file')) {
                $archivo = $request->file('file');
                $fileName = $archivo->getClientOriginalName();
                \Storage::disk('local')->put($fileName, \File::get($archivo));
            } else {
                return response()->json([
                    "msg" => "failure: There is no image."
                ], 500);
            }
            //Proceso para recuperar la ubicación de la imagen:
            //$pathImage = \Storage::get($archivo);

            $Publication = new \App\Models\Publicaciones();
            $Publication->nombre = $request->nombre;
            $Publication->precio = $request->precio;
            $Publication->inicioOferta = $request->inicioOferta;
            $Publication->finOferta = $request->finOferta;
            $Publication->detallesUbicacion = $request->detallesUbicacion;
            $Publication->user_id = $user->id;
            $Publication->save();

            return response()->json($Publication, 200
            );
        } catch (QueryException $e) {
            return response()->json([
                "msg" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = AuthenticateController::checkUser();
            $validator = Validator::make($request->all(), $this->validaciones);

            if ($validator->fails())
                return response()->json($validator->errors(), 422);

            $publicacion = $user->Publicaciones()->find($id);
            if ($publicacion == null)
                return response()->json(['message' => 'Publicacion no Encontrada'], 404);

            $publicacion->fill($request->all());
            $publicacion->save();
            return response()->json($publicacion);
        } catch (QueryException $e) {
            return response()->json([
                "msg" => $e->getMessage()
            ], 500);
        }

    }

    public function destroy()
    {

    }

    public function busqueda(Request $request)
    {
        //$Publicaciones = \App\Models\Publicaciones::get();
        if ($request->has('nombre')) {

            $Publicaciones = DB::table('Publicaciones')
                ->where('nombre', $request->nombre)
                ->get();
            return response()->json([
                "msg" => "success",
                "Publicaciones Encontradas" => $Publicaciones
            ], 200
            );
        }

    }


}

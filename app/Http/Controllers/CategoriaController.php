<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    
	public function index()
    {
    	$categoria = \App\Models\Categoria::get();

    	return response()->json([
    			"msg"=> "success",
    			"categoria"=> $categoria->toArray()
    	       ],200
    	);
    }

    public function store(Request $request)
    {   
        $categoria = new \App\Models\Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
                "msg"=> "success",
                "Categoria agregada: "=> $categoria->nombre
               ],200
        );
    }

    public function update(Request $request, $idCategoria)
    {
    	$categoria = \App\Models\Categoria::find($idCategoria);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
                "msg"=> "success"
               ],200
        );
    }

    public function destroy()
    {
        $categoria = \App\Models\Categoria::find($idCategoria );
        $categoria->delete();

        return response()->json([
                "msg"=> "success"
               ],200
        );
    }
}

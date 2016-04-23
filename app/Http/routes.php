<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::group(['middleware' => 'cors','prefix'=>'api'],function(){
	Route::get('User','UsuariosController@index');	
	Route::post('getUser','AuthenticateController@checkUser');
	Route::post('create','AuthenticateController@create');
	Route::post('login','AuthenticateController@authenticate');
	Route::get("usuarios","UsuariosController@index");
	Route::get('categoria','CategoriaController@index');
	Route::post('categoria','CategoriaController@store');
	Route::put('categoria/{idCategoria}','CategoriaController@update');
	Route::delete('categoria','CategoriaController@destroy');
	Route::post('crearPublicacion','PublicacionesController@store');
	Route::post('buscarPublicacion', 'PublicacionesController@busqueda');
	//Route::post('recuperarContrasena','Auth/PasswordController');

	//Publicaciones
	Route::get('publicaciones','PublicacionesController@showByUsuario');
	Route::put('publicaciones/{id}',
		'PublicacionesController@update')->where(['id'=>'[0-9]+']);

});
//Route::auth();

//Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

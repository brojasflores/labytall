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

Route::get('/', function () {
    return view('index');
    //return view('login');
    //return view('registro');
});

/*Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/

/*Route::get('auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as' => 'auth.login'
	]);

Route::post('auth/login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as' => 'auth.login'
	]);

Route::get('auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as' => 'auth.logout'
	]);*/

Route::get('auth/login', 'AutenticacionController@ShowLoginForm');
Route::post('auth/login', 'AutenticacionController@login');
Route::get('auth/area', 'AutenticacionController@secret');


Route::resource('/sala','salaController');
Route::resource('/usuario','usuarioController');
Route::resource('/contacto','contactoController');
Route::resource('/rol','rolController');
Route::resource('/periodo','periodoController');
Route::resource('/asignatura','asignaturaController');
Route::resource('/curso','cursoController');
Route::resource('/horario','horarioController');
Route::resource('/asignar','asignarController');
Route::get('/asignar_docente', ['as' => 'asignar.docente', 'uses' => 'asignarController@docente']);
Route::get('/asignar_ayudante',['as' => 'asignar.ayudante', 'uses' => 'asignarController@ayudante']);
Route::get('listado_graficas', 'GraficasController@index');


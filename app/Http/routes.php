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

Route::resource('/sala','salaController');
Route::resource('/usuario','usuarioController');
Route::resource('/contacto','contactoController');
Route::resource('/rol','rolController');


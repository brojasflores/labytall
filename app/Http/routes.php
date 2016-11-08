<?php

Route::resource('/','HomeController@index');
Route::get('/home', 'HomeController@index');
Route::resource('/perfil','HomeController@index');


//**********************************RUTAS ADMINISTRADOR*******************************************
Route::group(['prefix' => 'administrador','namespace' => 'Administrador'], function()
{
	Route::resource('/','administradorController@index');
	
	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'administrador.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'administrador.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);


	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');

	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'administrador.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'administrador.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::resource('/asignar_alumno','asignarAlumController');

	Route::get('/listado_graficas', 'GraficasController@index');
});

//**********************************RUTAS FUNCIONARIO*******************************************
Route::group(['prefix' => 'funcionario', 'namespace' => 'Funcionario'], function()
{
 	Route::resource('/','funcionarioController@index');

	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'funcionario.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'funcionario.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'funcionario.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'funcionario.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'funcionario.asignar.alumno', 'uses' => 'asignarController@alumno']);
	
	Route::get('/listado_graficas', 'GraficasController@index');
});

//***********************************RUTAS DOCENTE*******************************************
Route::group(['prefix' => 'docente', 'namespace' => 'Docente'], function()
{
	Route::resource('/','docenteController@index');

	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'docente.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'docente.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'docente.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'docente.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'docente.asignar.alumno', 'uses' => 'asignarController@alumno']);
	
	Route::get('/listado_graficas', 'GraficasController@index');
});

//***********************************RUTAS AYUDANTE*******************************************
Route::group(['prefix' => 'ayudante', 'namespace' => 'Ayudante'], function()
{
	Route::resource('/','ayudanteController@index');

	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'ayudante.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'ayudante.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'ayudante.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'ayudante.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'ayudante.asignar.alumno', 'uses' => 'asignarController@alumno']);
	
	Route::get('/listado_graficas', 'GraficasController@index');
});

//***********************************RUTAS ALUMNO*******************************************
Route::group(['prefix' => 'alumno', 'namespace' => 'Alumno'], function()
{
	Route::resource('/','alumnoController@index');

	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'alumno.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'alumno.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);
	
	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'alumno.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'alumno.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'alumno.asignar.alumno', 'uses' => 'asignarController@alumno']);
	
	Route::get('/listado_graficas', 'GraficasController@index');
});

Route::auth();



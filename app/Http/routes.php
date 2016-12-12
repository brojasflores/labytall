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
	Route::resource('/carrera','carreraController');
	Route::post('/upload_carrera', ['as' => 'administrador.carrera.update', 'uses' => 'carreraController@uploadCar']);
	Route::resource('/campus','campusController');
	Route::resource('/facultad','facultadController');
	Route::resource('/departamento','departamentoController');
	Route::resource('/escuela','escuelaController');

	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'administrador.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'administrador.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::resource('/asignar_alumno','asignarAlumController');

	Route::get('/listado_graficas', 'GraficasController@index');
});

//**********************************RUTAS Director*******************************************
Route::group(['prefix' => 'director','namespace' => 'Director'], function()
{
	Route::resource('/','directorController@index');
	
	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'director.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'director.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);
	Route::post('/upload_alumno', ['as' => 'director.usuario.update', 'uses' => 'usuarioController@uploadAlum']);
	Route::post('/upload_docente', ['as' => 'director.usuario.update', 'uses' => 'usuarioController@uploadDocente']);

	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/carrera','carreraController');
	Route::post('/upload_carrera', ['as' => 'director.carrera.update', 'uses' => 'carreraController@uploadCar']);

	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'director.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'director.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
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



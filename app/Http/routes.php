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
	Route::post('/upload_alumno', ['as' => 'administrador.usuario.upload', 'uses' => 'usuarioController@uploadAlum']);
	Route::post('/upload_docente', ['as' => 'administrador.usuario.upload', 'uses' => 'usuarioController@uploadDocente']);


	Route::resource('/contacto','contactoController');
	Route::resource('/rol','rolController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/carrera','carreraController');
	Route::post('/upload_carrera', ['as' => 'administrador.carrera.upload', 'uses' => 'carreraController@uploadCar']);
	Route::resource('/campus','campusController');
	Route::resource('/facultad','facultadController');
	Route::resource('/departamento','departamentoController');
	Route::resource('/escuela','escuelaController');

	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'administrador.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'administrador.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::resource('/asignar_alumno','asignarAlumController');

	Route::post('/upload_asignatura', ['as' => 'administrador.asignatura.upload', 'uses' => 'asignaturaController@uploadAsig']);

	Route::resource('/reportes', 'reportesController');
	Route::get('/reportes_usuario', ['as' => 'administrador.reportes.repusr', 'uses' => 'reportesController@RepUsr']);
	Route::get('/reportes_sala', ['as' => 'administrador.reportes.repsa', 'uses' => 'reportesController@RepSa']);
	Route::get('/reportes_asignaturas', ['as' => 'administrador.reportes.repasig', 'uses' => 'reportesController@RepAsig']);
	Route::get('/reportes_fallas', ['as' => 'administrador.reportes.repfalla', 'uses' => 'reportesController@RepFall']);

	Route::resource('/estacion','estacionController');

});

//**********************************RUTAS Director*******************************************
Route::group(['prefix' => 'director','namespace' => 'Director'], function()
{
	Route::resource('/','directorController@index');
	
	Route::resource('/sala','salaController');

	Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'director.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'director.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);
	Route::post('/upload_alumno', ['as' => 'director.usuario.upload', 'uses' => 'usuarioController@uploadAlum']);
	Route::post('/upload_docente', ['as' => 'director.usuario.upload', 'uses' => 'usuarioController@uploadDocente']);

	Route::resource('/contacto','contactoController');
	Route::resource('/periodo','periodoController');
	Route::resource('/asignatura','asignaturaController');
	Route::resource('/curso','cursoController');
	Route::resource('/horario','horarioController');
	Route::resource('/carrera','carreraController');
	Route::post('/upload_carrera', ['as' => 'director.carrera.upload', 'uses' => 'carreraController@uploadCar']);
	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'director.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'director.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::resource('/asignar_alumno','asignarAlumController');

	Route::post('/upload_asignatura', ['as' => 'director.asignatura.upload', 'uses' => 'asignaturaController@uploadAsig']);

	Route::resource('/reportes', 'reportesController');
	Route::get('/reportes_usuario', ['as' => 'director.reportes.repusr', 'uses' => 'reportesController@RepUsr']);
	Route::get('/reportes_sala', ['as' => 'director.reportes.repsa', 'uses' => 'reportesController@RepSa']);
	Route::get('/reportes_asignaturas', ['as' => 'director.reportes.repasig', 'uses' => 'reportesController@RepAsig']);
	Route::get('/reportes_fallas', ['as' => 'director.reportes.repfalla', 'uses' => 'reportesController@RepFall']);

	Route::resource('/estacion','estacionController');
});


//**********************************RUTAS FUNCIONARIO*******************************************
Route::group(['prefix' => 'funcionario', 'namespace' => 'Funcionario'], function()
{
 	Route::resource('/','funcionarioController@index');
	
	Route::resource('/sala','salaController');
 	
	Route::get('/usuario_perfil', ['as' => 'funcionario.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'funcionario.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');


	Route::resource('/horario','horarioController');
	Route::resource('/horarioAlumno','horarioAlumnoController');

	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'funcionario.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'funcionario.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::resource('/asignar_alumno','asignarAlumController');


	Route::resource('/reportes', 'reportesController');
	Route::get('/reportes_usuario', ['as' => 'funcionario.reportes.repusr', 'uses' => 'reportesController@RepUsr']);
	Route::get('/reportes_sala', ['as' => 'funcionario.reportes.repsa', 'uses' => 'reportesController@RepSa']);
	Route::get('/reportes_asignaturas', ['as' => 'funcionario.reportes.repasig', 'uses' => 'reportesController@RepAsig']);
	Route::get('/reportes_fallas', ['as' => 'funcionario.reportes.repfalla', 'uses' => 'reportesController@RepFall']);

	Route::resource('/estacion','estacionController');

});

//***********************************RUTAS DOCENTE*******************************************
Route::group(['prefix' => 'docente', 'namespace' => 'Docente'], function()
{
	Route::resource('/','docenteController@index');

	//Route::resource('/usuario','usuarioController'); 
	Route::get('/usuario_perfil', ['as' => 'docente.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'docente.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');


	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'docente.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'docente.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'docente.asignar.alumno', 'uses' => 'asignarController@alumno']);

	Route::resource('/MihorarioDocente','reservaController');

	Route::resource('/curso','cursoController');

});

//***********************************RUTAS AYUDANTE*******************************************
Route::group(['prefix' => 'ayudante', 'namespace' => 'Ayudante'], function()
{
	Route::resource('/','ayudanteController@index');

	Route::get('/usuario_perfil', ['as' => 'ayudante.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'ayudante.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);

	Route::resource('/contacto','contactoController');


	Route::resource('/horario','horarioController');
	Route::resource('/asignar','asignarController');
	Route::get('/asignar_docente', ['as' => 'ayudante.asignar.docente', 'uses' => 'asignarController@docente']);
	Route::get('/asignar_ayudante',['as' => 'ayudante.asignar.ayudante', 'uses' => 'asignarController@ayudante']);
	Route::get('/asignar_alumno',['as' => 'ayudante.asignar.alumno', 'uses' => 'asignarController@alumno']);

	Route::resource('/MihorarioAyudante','reservaController');

});

//***********************************RUTAS ALUMNO*******************************************
Route::group(['prefix' => 'alumno', 'namespace' => 'Alumno'], function()
{
	Route::resource('/','alumnoController@index');
 
	Route::get('/usuario_perfil', ['as' => 'alumno.usuario.perfil', 'uses' => 'perfilController@perfil']);
	Route::post('/usuario_perfilUpdate', ['as' => 'alumno.usuario.updateProfile', 'uses' => 'perfilController@updateProfile']);
	
	Route::resource('/contacto','contactoController');

	Route::resource('/horarioAlumno','horarioAlumnoController');
	Route::resource('/asignar','asignarController');
	Route::resource('/asignar_alumno','asignarAlumController');
	Route::resource('/MihorarioAlumno','reservaController');
	
});

Route::auth();



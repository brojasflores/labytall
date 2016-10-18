@extends('main')
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Administración</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Gestión Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <!--Controlador.metodo-->
                <li><a href="pages/usuarios/admin.html"><i class="glyphicon glyphicon-barcode"></i> Autenticación</a></li>
                <li><a href="{{ route('usuario.index')}}"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="{{ route('rol.index')}}"><i class="fa fa-wrench"></i> Roles</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <!--route ruta del controlador.metodo-->
                <li><a href="{{ route('sala.index')}}"><i class="fa fa-list-alt"></i>Lista de Salas</a></li>
                <li><a href="{{ route('periodo.index')}}"><i class="fa fa-clock-o"></i> Períodos</a></li>
                <li><a href="{{ route('asignatura.index')}}"><i class="fa fa-pencil-square-o"></i> Asignaturas</a></li>
                <li><a href="{{ route('curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
                <li><a href="{{ route('asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/labs/admin.html"><i class="fa fa-users"></i>Usuarios</a></li>
                <li><a href="pages/labs/admin.html"><i class="fa fa-tv"></i>Salas</a></li>
                <li><a href="pages/labs/docente.html"><i class="fa fa-hand-pointer-o"></i>Usabilidad</a></li>
                <li><a href="pages/labs/ayudante.html"><i class="fa  fa-book"></i>Asignaturas</a></li>
                <!--li><a href="pages/labs/alumno.html"><i class="fa fa-calendar"></i>Fechas</a></li-->
                <li class="active"><a href="javascript:void(0);" onclick="cargarlistado(4);" ><i class="fa fa-calendar"></i>Fechas</a></li>
                <li><a href="pages/labs/alumno.html"><i class="fa fa-exclamation-triangle"></i>Instrumentos dañados (Fallas)</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-globe"></i> <span>Accesos Directos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="http://www.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Página Principal</a></li>
                <li><a href="http://mi.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Mi UTEM</a></li>
                <li><a href="http://postulacion.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> DIRDOC</a></li>
                <li><a href="http://reko.utem.cl/portal/" target="_blank"><i class="fa fa-external-link"></i> REKO</a></li>
                <li><a href="http://intranet.utem.cl/cb29be8b14c3c70e69672ae008310977/intranet/" target="_blank"><i class="fa fa-external-link"></i> Intranet</a></li>
                <li><a href="http://biblioteca.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Catálogo Biblioteca</a></li>
                <li><a href="http://bienestarestudiantil.blogutem.cl/" target="_blank"><i class="fa fa-external-link"></i> Bienestar Estudiantil</a></li>
              </ul>
            </li>
            <li><a href="{{ route('contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
<li class="active">Editar Cursos</li>
@stop
@section('content')
<h1>Editar Curso</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($cursos,['route' => ['curso.update',$cursos], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Asignatura: </label>
					  <select class="form-control" id="asignaturas" name="asigCurso">
					  	@foreach($asignaturas as $asig)
					    	<option value="{{ $asig->id }}" name="asigCurso">{{ $asig->nombre }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>
		    	
		    </div>
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Semestre</label>
	      <input type="text" class="form-control" value="{{ $cursos->semestre}}" name="semestreCurso" id="semestreCurso" placeholder="Ingrese hora inicio período (Ej. 08:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Año</label>
	      <input type="text" class="form-control" value="{{ $cursos->anio}}" name="anioCurso" id="anioCurso" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Sección</label>
	      <input type="text" class="form-control" value="{{ $cursos->seccion}}" name="seccionCurso" id="seccionCurso" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
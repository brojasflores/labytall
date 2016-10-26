@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
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
<li><a href="{{ route('usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Agregar Usuarios</li>
@stop
@section('content')
<h1>Agregar Usuario</h1>
<form role="form" method="post" action="{{ route('usuario.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Rut</label>
	      <input type="text" class="form-control" name="rutUsuario" id="rutUsuario" placeholder="Ingrese Rut">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Email</label>
	      <input type="text" class="form-control" name="emailUsuario" id="emailUsuario" placeholder="Ingrese Email">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Nombres</label>
	      <input type="text" class="form-control" name="nombresUsuario" id="nombresUsuario" placeholder="Ingrese Nombres">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Apellidos</label>
	      <input type="text" class="form-control" name="apellidosUsuario" id="apellidosUsuario" placeholder="Ingrese Apellidos">
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		@foreach($roles as $rol)
	    		<div class="col-md-2">
			    	<div class="checkbox">
				    	<!-- Para imprimir el valor de una variable hay que escribir como está aca-->
				    	<label><input type="checkbox" value="{!! $rol->id !!}" name="roles[]">{!! $rol->nombre!!}</label>
			    	</div>
		    	</div>
		    	@endforeach
		    </div>
	    </div>
	    <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
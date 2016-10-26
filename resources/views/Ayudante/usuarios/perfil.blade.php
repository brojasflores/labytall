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
            <li class="header">Docente</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
@section('options')
<h1>
    Gestión Usuarios 
  <small>Usuarios</small>
</h1>
@stop
@section('opcion')
<li><a href="{{ route('usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Perfil Usuario</li>
@stop
@section('content')
<h1>Perfil Usuario</h1>
<h2>Cambiar imagen de perfil</h2>
<form method='post' action='{{url("usuario_perfilUpdate")}}' enctype='multipart/form-data'>
  {{csrf_field()}}
    <div class="row">
	  	<div class="col-md-4">
		    <div class="form-group">
			  <label for="exampleInputPassword1">Email</label>
			  <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="emailUsuario" id="email">
			</div> 
		</div>
	</div>
	<div class="row">
	  	<div class="col-md-4">
		    <div class="form-group">
			  <label for="exampleInputPassword1">Nombres</label>
			  <input type="text" class="form-control" value="{{ Auth::user()->nombres }}" name="nombres" id="nombres">
			</div> 
		</div>
	</div>
	<div class="row">
	  	<div class="col-md-4">
		    <div class="form-group">
			  <label for="exampleInputPassword1">Apellidos</label>
			  <input type="text" class="form-control" value="{{ Auth::user()->apellidos }}" name="apellidos" id="apellidos">
			</div> 
		</div>
	</div>
	<div class="row">
	  	<div class="col-md-4">
		  <div class='form-group'>
		    <label for='image'>Imagen: </label>
		    <input type="file" name="image" />
		    <div class='text-danger'>{{$errors->first('image')}}</div>
		  </div>
		</div>
	</div>
  <button type='submit' class='btn btn-primary'>Actualizar Datos</button>
</form>

@stop

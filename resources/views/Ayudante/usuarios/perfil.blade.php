@extends('main')
@section('cambioRol')
<style type="text/css">
.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 197px;
}
.dropdown-menu>li>a {
    color: #333;
}
.navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
   margin-top: 0px;
}
p {
    margin: 0 0 5px;
}
hr {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>
  @if($cont>1)
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <img src="{{asset('admin-lte/dist/img/cambio.png')}}" class="user-image" alt="User Image">
      <span class="hidden-xs">Cambio Rol</span>
    </a>
    <ul class="dropdown-menu">
      <li class="user-header">
        <p>
          Elija el Rol que quiera utilizar
        </p>
        @foreach($v2 as $as)
          @if($as == 'administrador')
            <a href="{{ route('administrador..index')}}"><i class="fa fa-mail-forward"></i> Administrador</a>
          @endif
          @if($as == 'director')
            <a href="{{ route('director..index')}}"><i class="fa fa-mail-forward"></i> Director</a>
          @endif
          @if($as == 'funcionario')
            <a href="{{ route('funcionario..index')}}"><i class="fa fa-mail-forward"></i> Funcionario</a>
          @endif
          @if($as == 'docente')
            <a href="{{ route('docente..index')}}"><i class="fa fa-mail-forward"></i> Docente</a>
          @endif
          @if($as == 'ayudante')
            <a href="{{ route('ayudante..index')}}"><i class="fa fa-mail-forward"></i> Ayudante</a>
          @endif
          @if($as == 'alumno')
            <a href="{{ route('alumno..index')}}"><i class="fa fa-mail-forward"></i> Alumno</a>
          @endif
        @endforeach
      </li>
    </ul>
  </li>
@endif
@stop
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('ayudante.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
    <li class="header">Ayudantes</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-desktop"></i> <span>Salas</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-eye"></i> <span>Ver Horarios</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ayudante.horario.index')}}"><i class="fa fa-clock-o"></i>Ayudante</a></li>
          </ul>
        </li>
        <li><a href="{{ route('ayudante.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
    <li><a href="{{ route('ayudante.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
  </ul>
@stop
@section('options')
<h1>
    Panel de Control 
  <small>Inicio</small>
</h1>
@stop
@section('opcion')
<li class="active">Perfil Usuario</li>
@stop
@section('content')
<h1>Perfil Usuario</h1>
@if(count($errors)>0)
  <div class="alert alert-danger">
      <p><strong>¡Alerta! </strong> Por favor corrija el(los) siguiente(s) errore(s):</p>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
  </div>
@endif
<h2>Cambiar imagen de perfil</h2>
<form  method='post' action='{{url("ayudante/usuario_perfilUpdate")}}' enctype='multipart/form-data'>
  {{csrf_field()}}
    <div class="row">
	  	<div class="col-md-4">
		    <div class="form-group">
			  <label for="exampleInputPassword1">Email</label>
			  <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email" id="email">
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

  @if($var2)
        <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputPassword1">Contraseña (Opcional)</label>
          <input type="password" class="form-control" name="passwordUsuario" id="passwordUsuario" placeholder="Ingrese contraseña nueva">
        </div> 
      </div>
  </div>
  @endif
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

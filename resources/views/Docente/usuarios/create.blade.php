@extends('main')
@section('cambioRol')
  @if($cont>1)
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <img src="{{asset('admin-lte/dist/img/cambio.png')}}" class="user-image" alt="User Image">
      <span class="hidden-xs">Cambio Rol</span>
    </a>
    <ul class="dropdown-menu">
      <li class="user-header">
        <p>
          Eliga el Rol que quiera utilizar
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
    <a href="{{route('docente.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
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
                <li><a href="{{ route('docente.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('docente.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('docente.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('docente.usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Agregar Usuarios</li>
@stop
@section('content')
<h1>Agregar Usuario</h1>
<form role="form" method="post" action="{{ route('docente.usuario.store')}}">
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
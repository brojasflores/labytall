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
<li class="dropdown user user-menu">
    <a>
    <form role="form" method="post" action="{{ route('administrador.actualiza.store') }}">     
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <img src="{{asset('admin-lte/dist/img/act.png')}}" class="user-image" alt="User Image">        
        <input class="btn-default hidden-xs" type="submit" value="Base de Datos" style="
            background: transparent;
            border: none;
            color: #fff;
            outline: none;
        ">            
    </form>
    </a>  
  </li>
  <li class="dropdown user user-menu">
    <a>
    <form role="form" method="get" action="{{ route('administrador.descarga.download') }}">     
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <img src="{{asset('admin-lte/dist/img/download.png')}}" class="user-image" alt="User Image">        
        <input class="btn-default hidden-xs" type="submit" value="Base de Datos" style="
            background: transparent;
            border: none;
            color: #fff;
            outline: none;
        ">            
    </form>
    </a>  
  </li>
  <li class="dropdown user user-menu">
    <a>
    <form role="form" method="get" action="{{ route('administrador.formatos.download') }}">     
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <img src="{{asset('admin-lte/dist/img/download.png')}}" class="user-image" alt="User Image">        
        <input class="btn-default hidden-xs" type="submit" value="Formatos" style="
            background: transparent;
            border: none;
            color: #fff;
            outline: none;
        ">            
    </form>
    </a>  
  </li>
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
    <a href="{{route('administrador.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
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
                <i class="fa fa-university"></i> <span>Universidad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <!--Controlador.metodo-->
                <li><a href="{{ route('administrador.campus.index')}}"><i class="fa fa-th"></i> Campus</a></li>
                <li><a href="{{ route('administrador.facultad.index')}}"><i class="fa fa-th"></i> Facultades</a></li>
                <li><a href="{{ route('administrador.departamento.index')}}"><i class="fa fa-th"></i> Departamentos</a></li>
                <li><a href="{{ route('administrador.escuela.index')}}"><i class="fa fa-th"></i> Escuelas</a></li>
                <li><a href="{{ route('administrador.carrera.index')}}"><i class="fa fa-th"></i> Carreras</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Gestión Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('administrador.usuario.index')}}"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="{{ route('administrador.rol.index')}}"><i class="fa fa-wrench"></i> Roles</a></li>
              </ul>
            </li>
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
                    <li><a href="{{ route('administrador.horario.index')}}"><i class="fa fa-clock-o"></i> Docente-Ayudante</a></li>
                    <li><a href="{{ route('administrador.horarioAlumno.index')}}"><i class="fa fa-clock-o"></i> Alumno</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('administrador.sala.index')}}"><i class="fa fa-list-alt"></i>Lista de Salas</a></li>
                <li><a href="{{ route('administrador.estacion.index')}}"><i class="fa fa-laptop"></i>Estaciones de Trabajo</a></li>
                <li><a href="{{ route('administrador.periodo.index')}}"><i class="fa fa-clock-o"></i> Períodos</a></li>
                <li><a href="{{ route('administrador.asignatura.index')}}"><i class="fa fa-pencil-square-o"></i> Asignaturas</a></li>
                <li><a href="{{ route('administrador.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
                <li><a href="{{ route('administrador.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
                <li><a href="{{ route('administrador.autentica.index')}}"><i class="fa fa-check-square"></i> Asistencia</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/administrador/reportes_usuario')}}"><i class="fa fa-users"></i>Usuarios</a></li>
                <li><a href="{{ url('/administrador/reportes_sala')}}"><i class="fa fa-tv"></i>Salas</a></li>
                <li><a href="{{ url('/administrador/reportes_asignaturas')}}"><i class="fa  fa-book"></i>Asignaturas</a></li>
                <li><a href="{{ url('/administrador/reportes_fallas')}}"><i class="fa fa-exclamation-triangle"></i>Instrumentos dañados (Fallas)</a></li>
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
            <li><a href="{{ route('administrador.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
            <li><a href="{{ route('administrador.contacto.create')}}" target="_blank"><i class="fa fa-share"></i> <span>Enviar Correo</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('administrador.escuela.index')}}"><i class="fa fa-clock-o"></i> Escuelas</a></li>
<li class="active">Agregar Escuelas</li>
@stop
@section('content')
<h1>Agregar Escuelas</h1>
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
<form role="form" method="post" action="{{ route('administrador.escuela.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Nombre</label>
	      <input type="text" class="form-control" name="nombre" id="nombreEsc" placeholder="Ingrese nombre de la escuela">
	    </div>
	    <div class="form-group">
        <div class="row">
          <div class="col-md-2">
          <div class="form-group">
            <label for="sel1">Departamento: </label>
            <select class="form-control" id="depEsc" name="departamento_id">
            @foreach($departamentos as $dep)
                <option value="{{ $dep->id }}" name="depEsc">{{ $dep->nombre }}</option>
            @endforeach
            </select>
          </div>
          </div>
        </div>
      </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Descripción</label>
	      <input type="text" class="form-control" name="descripcion" id="desEsc" placeholder="Ingrese descripción de la escuela">
	    </div>
	    <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop



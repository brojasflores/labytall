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
    <form role="form" method="get" action="{{ route('funcionario.descarga.download') }}">     
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
    <form role="form" method="get" action="{{ route('funcionario.formatos.download') }}">     
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
    <a href="{{route('funcionario.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Funcionarios</li>
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
                    <li><a href="{{ route('funcionario.horario.index')}}"><i class="fa fa-clock-o"></i> Docente-Ayudante</a></li>
                    <li><a href="{{ route('funcionario.horarioAlumno.index')}}"><i class="fa fa-clock-o"></i> Alumno</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('funcionario.sala.index')}}"><i class="fa fa-list-alt"></i>Lista de Salas</a></li>
                <li><a href="{{ route('funcionario.estacion.index')}}"><i class="fa fa-laptop"></i>Estaciones de Trabajo</a></li>
              
                <li><a href="{{ route('funcionario.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
                <li><a href="{{ route('funcionario.autentica.index')}}"><i class="fa fa-check-square"></i> Asistencia</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/funcionario/reportes_usuario')}}"><i class="fa fa-users"></i>Usuarios</a></li>
                <li><a href="{{ url('/funcionario/reportes_sala')}}"><i class="fa fa-tv"></i>Salas</a></li>
                <li><a href="{{ url('/funcionario/reportes_asignaturas')}}"><i class="fa  fa-book"></i>Asignaturas</a></li>
                <li><a href="{{ url('/funcionario/reportes_fallas')}}"><i class="fa fa-exclamation-triangle"></i>Instrumentos dañados (Fallas)</a></li>
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
            <li><a href="{{ route('funcionario.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
            <li><a href="{{ route('funcionario.contacto.create')}}" target="_blank"><i class="fa fa-share"></i> <span>Enviar Correo</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('funcionario.sala.index')}}"><i class="fa fa-desktop"></i> Salas</a></li>
<li class="active">Editar Salas</li>
@stop
@section('content')
<h1>Editar Sala</h1>
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
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($sala,['route' => ['funcionario.sala.update',$sala], 'method' => 'PUT']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Nombre Sala</label>
        <input type="text" class="form-control" value="{{ $sala->nombre}}" name="nombre" id="nombreSala" placeholder="Ingrese nombre">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Capacidad</label>
        <input type="text" class="form-control" value="{{ $sala->capacidad}}" name="capacidad" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
      </div>
      <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
    </div><!-- /.box-body -->

{!! Form::close() !!}
@stop
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
    <a href="{{route('docente.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
    <li class="header">Docencia</li>
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
            <li><a href="{{ route('docente.horario.index')}}"><i class="fa fa-clock-o"></i> Docente-Ayudante</a></li>
          </ul>
        </li>
        <li><a href="{{ route('docente.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
      </ul>
      <ul class="treeview-menu">
        <li><a href="{{ route('docente.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Ayudantía</a></li>
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
<li><a href="{{ route('docente.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
<li class="active">Agregar Cursos</li>
@stop
@section('content')
<br>
@if(Session::has('create'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-link">{{ Session::get('create') }}</strong>
    </div>
@endif
<h1>Agregar Curso</h1>
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
<form role="form" method="post" action="{{ route('docente.curso.store')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
      <div class="form-group">
        <div class="row">
        
          <div class="col-md-2">
          <div class="form-group">
            <label for="sel1">Asignatura: </label>
            <select class="form-control" id="asignaturas" name="asignatura_id">
              @foreach($asignaturas as $asig)
                <option value="{{ $asig->id }}" name="asignatura_id">{{ $asig->nombre}} - {{ $asig->carr}}</option>
            @endforeach
            </select>
          </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Semestre</label>
        <input type="text" class="form-control" name="semestre" id="semestreCurso" placeholder="Ingrese semestre (Ej. 1 ó 2)">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Año</label>
        <input type="text" class="form-control" name="anio" id="anioCurso" placeholder="Ingrese año">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Sección</label>
        <input type="text" class="form-control" name="seccion" id="seccionCurso" placeholder="Ingrese sección (Ej. 1, 2, 3)">
      </div>
      <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
    </div><!-- /.box-body -->
</form>
@stop
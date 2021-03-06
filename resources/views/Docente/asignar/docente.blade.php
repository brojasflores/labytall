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
@section('options')
<h1>
    Salas 
  <small>Reserva Docente</small>
</h1>
@stop
@section('opcion')
<li><a href="{{ route('docente.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reserva</a></li>
<li class="active">Reserva Docente</li>
@stop
@section('content')
@if(Session::has('create'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-link">{{ Session::get('create') }}</strong>
    </div>
@endif
<div class="row" style="margin-left: 0px">

<form role="form" method="post" action="{{ route('docente.asignar.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Salas: </label>
            <select class="form-control" id="sala_id" name="sala_id">
              @foreach($salas as $sala)
                <option value="{{ $sala->id }}" name="sala_id">{{ $sala->nombre }}</option>
            @endforeach
            </select>
          </div>
          </div>          
        </div>
      </div>  
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Permanencia: </label>
            <select class="form-control" id="permanencia" name="permanencia">
                <option value="0">Seleccione</option>
                <option value="semestral" name="semestral">Semestral</option>
                <option value="dia" name="dia">Día</option>
            </select>
          </div>
          </div>          
        </div>
      </div>     
      <div class="form-group">
        <div class="row">
          <div class="col-md-3" id="col-fecha" style="display: none;">
          <div class="form-group">
            <label for="sel1">Fecha: </label>
              <input type="text" class="form-control" placeholder="Fecha" name="fecha" id="fecha" aria-describedby="basic-addon2">
          </div>
          </div>
          <div class="col-md-3" id="col-dia" style="display: none";>
          <div class="form-group">
            <label for="sel1">Día: </label>
            <select class="form-control" id="dia" name="dia">
                <option value="lunes" name="dia">Lunes</option>
                <option value="martes" name="dia">Martes</option>
                <option value="miercoles" name="dia">Miércoles</option>
                <option value="jueves" name="dia">Jueves</option>
                <option value="viernes" name="dia">Viernes</option>
                <option value="sabado" name="dia">Sábado</option>                               
              </select>
          </div>
          </div>            
          <div class="col-md-3" id="col-fecha-ini" style="display: none";>
          <div class="form-group">
            <label for="sel1">Fecha Inicio: </label>
              <input type="text" class="form-control" placeholder="Fecha" name="fecha_inicio" id="fecha_inicio" aria-describedby="basic-addon2">
          </div>
          </div>  
          <div class="col-md-3" id="col-fecha-fin" style="display: none";>
          <div class="form-group">
            <label for="sel1">Fecha Fin: </label>
              <input type="text" class="form-control" placeholder="Fecha" name="fecha_fin" id="fecha_fin" aria-describedby="basic-addon2">
          </div>
          </div>                                
        </div>
      </div>  
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Período: </label>
            <select class="form-control" id="periodo_id" name="periodo_id">
              @foreach($periodos as $periodo)
                <option value="{{ $periodo->id }}" name="periodo_id">{{ $periodo->bloque }}</option>
            @endforeach
            </select>
          </div>
          </div>          
        </div>
      </div>   
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Curso: </label>
            <select class="form-control" id="curso_id" name="curso_id">
              @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" name="curso_id">{{ $curso->nombre }} - {{ $curso->seccion }}</option>
            @endforeach
            </select>
          </div>
          </div>        
        </div>
      </div>      
      <input type="hidden" name="rol" value="docente">
    <button type="submit" class="fa fa-edit btn btn-primary">Reservar</button>
  </div>
</div>
@stop

@section('scripts')
  <script>

  $( function() {
    $( "#fecha" ).datepicker({
      showButtonPanel: true
    });
    $( "#fecha_inicio" ).datepicker({
      showButtonPanel: true
    });
    $( "#fecha_fin" ).datepicker({
      showButtonPanel: true
    });
  } );
  $(document).ready(function(){
    $("#permanencia").change(function(){
      if($("#permanencia").val() == 'semestral')
      {
        $("#col-fecha").css('display','none');
        $("#col-dia").css('display','block');
        $("#col-fecha-ini").css('display','block');
        $("#col-fecha-fin").css('display','block');
      }
      if($("#permanencia").val() == 'dia')
      {
        $("#col-fecha").css('display','block');
        $("#col-dia").css('display','none');
        $("#col-fecha-ini").css('display','none');
        $("#col-fecha-fin").css('display','none');
      }
    });
  });
  </script>
@stop



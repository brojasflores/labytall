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
    <a href="{{route('alumno.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Alumnos</li>        
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
                    <li><a href="{{ route('alumno.horarioAlumno.index')}}"><i class="fa fa-clock-o"></i> Alumno</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('alumno.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('alumno.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('options')
<h1>
    Salas 
  <small>Reserva Alumno</small>
</h1>
@stop
@section('opcion')
<li><a href="{{ route('alumno.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reserva</a></li>
<li class="active">Reserva Alumno</li>
@stop
@section('content')
@if(Session::has('create'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-link">{{ Session::get('create') }}</strong>
    </div>
@endif
<div class="row" style="margin-left: 0px">

<form role="form" method="post" action="{{ route('alumno.asignar_alumno.store') }}">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="box-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Salas: </label>
            <select class="form-control" id="sala" name="sala">
              <option value="0" name="sala">Seleccione</option>
              @foreach($salas as $sala)
                <option value="{{ $sala->id }}" name="sala">{{ $sala->nombre }}</option>
            @endforeach
            </select>
          </div>
          </div>          
        </div>
      </div>     
      <div class="form-group">
        <div class="row">
          <div class="col-md-3" id="col-fecha">
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
        </div>
      </div>  
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Período: </label>
            <select class="form-control" id="periodo" name="periodo">
              @foreach($periodos as $periodo)
                <option value="{{ $periodo->id }}" id="periodo" name="periodo">{{ $periodo->bloque }}</option>
              @endforeach
            </select>
          </div>
          </div>          
        </div>
      </div>  
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group" id="estaciones" style="display: none;">
            <label for="sel1">Estaciones de Trabajo: </label>
              <select class="form-control" id="estacion" name="estacion"> 
            </select>
          </div>
          </div>
        </div>
      </div>   
      <input type="hidden" name="rol" value="alumno"> 
    <button type="submit" class="fa fa-edit btn btn-primary">Reservar</button>
  </div>
</div>
@stop

@section('scripts')
  <script>

  $( function(){
    $( "#fecha" ).datepicker({
      showButtonPanel: true
    });

  });

  $(document).ready(function(){
    //# es para llamar una id

      $("#sala, #periodo").change(function(){
      var id = $("#sala").val();
      var periodo = $("#periodo").val();
      var token = $("#token").val();
      $.ajax({
        url: '/~brojas/alumno/asignar_alumno',
        headers:{'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{id : id,periodo : periodo},
        //response es la respuesta que trae desde el controlador
        success: function(response){  
          $("#estacion").empty();
          $("#estaciones").css('display','block');
          //el k es un índice (posición) y v (valor como tal del elemento)
          $.each(response,function(k,v){
          $("#estacion").append("<option value='"+v.id+"' name='sala'>"+v.sala+" - Estación N°"+v.nombre+" - Periodo:"+v.blo+"</option>");
          });
          
        }
      });
  });
      

  });

  </script>
@stop

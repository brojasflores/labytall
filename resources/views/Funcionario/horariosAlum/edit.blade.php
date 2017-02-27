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
                <li><a href="{{ route('funcionario.periodo.index')}}"><i class="fa fa-clock-o"></i> Períodos</a></li>
                <li><a href="{{ route('funcionario.asignatura.index')}}"><i class="fa fa-pencil-square-o"></i> Asignaturas</a></li>
                <li><a href="{{ route('funcionario.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
                <li><a href="{{ route('funcionario.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('funcionario.horarioAlumno.index')}}"><i class="fa fa-clock-o"></i> Horarios Alumnos</a></li>
<li class="active">Editar Horarios</li>
@stop
@section('content')
<h1>Editar Horario Alumnos</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($horarios,['route' => ['funcionario.horarioAlumno.update',$horarios], 'method' => 'PUT']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
     
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Salas: </label>
            <select class="form-control" id="sala_id" name="salaHorario">
              
              @foreach($salas as $sal)
                <option id="{{ $sal->id }}" value="{{ $sal->id }}" name="salaHorario">{{ $sal->nombre }}</option>
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
        </div>
      </div> 
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Período: </label>
            <select class="form-control" id="periodo_id" name="periodoHorario">
              @foreach($periodos as $per)
                <option id="{{ $per->id }}" value="{{ $per->id }}" name="periodoHorario">{{ $per->bloque }}</option>
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
            <label for="sel1">Estaciones de Trabajo: </label>
            <select class="form-control" id="estacion" name="estacion">
              @foreach($est as $e)
            
                <option value="{{ $e->est_id }}" id="{{ $e->est_id }}" name="estacion">{{ $e->nombre }} - Estación N° {{$e->est_name}}</option>
            
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
            <label for="sel1">Rut: </label>
              <input type="text" class="form-control" value="{{ $rut }}" name="rutHorario" id="rutHorario" aria-describedby="basic-addon2"> 
          </div>
          </div>
        </div>
      </div> 
      <div class="form-group">
        <div class="row">
          <div class="col-md-3">
          <div class="form-group">
            <label for="sel1">Asistencia: </label>
            <select class="form-control" id="asistenciaH" name="asistenciaH">
                  <option id="Pendiente" value="Pendiente" name="asistenciaH">Pendiente</option>
                  <option id="si" value="si" name="asistenciaH">Sí</option>
                  <option id="no" value="no" name="asistenciaH">No</option>
            </select>
          </div>
          </div>
        </div>
      </div>    
      <input type="hidden" id="horario_id" value="{{ $horarios->id }}">
      <input type="hidden" name="rol" value="alumno">
      <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
    </div><!-- /.box-body -->
{!! Form::close() !!}
@stop

@section('scripts')
<script>
$( function() {
$( "#fecha" ).datepicker({
  showButtonPanel: true
});

} );

$(document).ready(function(){
    //# es para llamar una id
    $("#sala_id,#periodo_id").change(function(){
      var id = $("#sala_id").val();
      var periodo = $("#periodo_id").val();
      var token = $("#token").val();
      $.ajax({
        url: '/~brojas/funcionario/horarioAlumno/'+id+'/edit',
        headers:{'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data:{id : id,periodo:periodo,action: 'edit'},
        //response es la respuesta que trae desde el controlador
        success: function(response){  
          $("#estacion").empty();
         console.log(response);
          //el k es un índice (posición) y v (valor ocmo tal del elemento)
          $.each(response,function(k,v){
          $("#estacion").append("<option value='"+v.id+"' name='sala'>"+v.sala+" - Estación N°"+v.nombre+"- Periodo:"+v.blo+"</option>");
          }); 
        }
      });
    });

  $.ajax({
    // con .val saco el valor del value
        data:  {'id': $("#horario_id").val()},
        url:   '/~brojas/funcionario/horarioAlumno/'+$("#horario_id")+'/edit',
        type:  'get',
        dataType: 'json',
        success:  function(respuesta) {   
        console.log(respuesta.estacion_trabajo_id);

        $('#sala_id option[id='+respuesta.sala_id+']').attr('selected', 'selected');
    $('#periodo_id option[id='+respuesta.periodo_id+']').attr('selected', 'selected');
    $('#estacion option[id='+respuesta.estacion_trabajo_id+']').attr('selected', 'selected'); 
    var fecha_split = (respuesta.fecha).split('-');
    console.log(fecha_split);
    $('#fecha').val(fecha_split[1]+'/'+fecha_split[2]+'/'+fecha_split[0]);

        }
    });
    $('#asistenciaH option[id={{ $horarios->asistencia }}]').attr('selected', 'selected');
});

</script>

@stop
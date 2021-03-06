@extends('main')
@section('cambioRol')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
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
@section('content')

  <div class="row">
    <div class="col-md-10 col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h2> Estadísticas Asignaturas</h2>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif                                    
                    </div>
                    <div class="col-md-6 col-lg-6">
                    </div>
               </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <div class="row">
                  <div class="col-md-12">
                    <div id="ErrorContent" class="alert alert-danger hide">
                      
                    </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Usabilidad de Laboratorios por Asignaturas
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="asignatura-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Usabilidad de Laboratorios por Curso
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="asigCur-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Usabilidad de Laboratorios por Alumno
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="salAlum-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>


                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <div class="col-md-2 col-lg-2">
       <div class="row">
          <div class="col-lg-12">
              <div class="form-group" id="form-fecha-ini">
                  <h4>Fecha de inicio</h4>
                  <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" id="fecha_inicio" name="fecha_inicio">
              </div>                                
          </div>
          <div class="col-lg-12">
              <div class="form-group" id="form-fecha-term">
                  <h4>Fecha de término</h4>
                  <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" id="fecha_termino" name="fecha_termino">
              </div>
          </div>    
          <div class="col-lg-12">
                <label for="sel1">Asignatura </label>
                <select class="form-control" id="asig" name="asig">               
                  @foreach($asignatura as $as)
                    <option id="{{ $as->id }}" value="{{ $as->id }}, {{$as->nombre}}" name="asig">{{ $as->nombre }}</option>
                @endforeach
                </select>
          </div> 
          <div class="form-group">
            <label for="exampleInputEmail1">Rut (con DV y sin guión)</label>
            <input type="text" class="form-control" name="rut" id="rut" placeholder="Ingrese Rut">
          </div>
          <div class="col-md-6 col-md-offset-3"> 
            <button class="btn btn-block btn-success filtro" id="buscar" name="buscar" value="buscar">Buscar</button>
          </div>
      </div>      
    </div>
  </div>
@stop

@section('scripts')

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
    $("#asig option").eq(0).prop("selected",true);
    
    $("#fecha_inicio").datepicker();
    $("#fecha_termino").datepicker();
    var asig = $("#asig").val().split(',');
    var rut = $("#rut").val();
    
    $("#buscar").click();

    /*
    column_chart('asignatura','','',['','']);
    column_chart('asigCur','','',['','']);
    column_chart('salAlum','','',['','']);
    */
    
  });

  $("#buscar").click(function(){

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_termino = $("#fecha_termino").val();
    var asig = $("#asig").val().split(',');
    var rut = $("#rut").val();

    column_chart('asignatura',fecha_inicio,fecha_termino,asig,rut);
    column_chart('asigCur',fecha_inicio,fecha_termino,asig,rut);
    column_chart('salAlum',fecha_inicio,fecha_termino,asig,rut);

  });

  function column_chart(tipo,fecha_inicio,fecha_termino,asig,rut){

    console.log(asig);

    if(tipo == 'asignatura')
    {
      nombre = 'Usabilidad de Laboratorios por Asignaturas más recurrentes'
      ejey = 'Número de Reservas'
      subtitulo = ''    
    }

    if(tipo == 'asigCur')
    {
      nombre = 'Usabilidad de Laboratorios por Cursos'
      ejey = 'Número de Reservas'
      subtitulo = 'Asignatura: ' + asig[1]
    }

    if(tipo == 'salAlum')
    {
      nombre = 'Usabilidad de Laboratorios por Alumnos más recurrentes'
      ejey = 'Número de Reservas'
      subtitulo = 'Rut Alumno: ' + rut
    }

    var options =  {
        chart: {
            renderTo: tipo+'-chart',
            type: 'column'
        },
        title: {
            text: nombre
        },
        subtitle: {
            text: subtitulo
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                },
          
                formatter: function() {
                  if (tipo == 'asigCur') {
                      return 'Sección: ' + this.value.toString();
                  }else{
                      return this.value.toString();
                  }
                      
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ejey
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Uso: <b>{point.y:.1f} reservas</b>'
        },
        series: [{
            name: 'Population',
            data: [],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    };
    

    $.getJSON("{{ route('funcionario.reportes.repasig') }}",{tipo: tipo,fecha_inicio: fecha_inicio, fecha_termino: fecha_termino, asig:asig[0],rut:rut}, function(json) {

        console.log(json);

        if (json.error.isError){

          $("#ErrorContent").removeClass('hide');
          $("#ErrorContent").html(json.error.mensaje);
          //console.log(json);
          
           $.each(json.data,function(k,v){
                options.series[0].data.push(v);
            }); 

            chart = new Highcharts.Chart(options);

         }else{
           $("#ErrorContent").addClass('hide');
         }

        

        $.each(json.data,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);

    });
  }   

</script>


@stop


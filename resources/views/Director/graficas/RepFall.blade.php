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
    <form role="form" method="get" action="{{ route('director.descarga.download') }}">     
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
    <a href="{{route('director.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Dirección</li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-university"></i> <span>Universidad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('director.carrera.index')}}"><i class="fa fa-th"></i> Carreras</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Gestión Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('director.usuario.index')}}"><i class="fa fa-users"></i> Usuarios</a></li>
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
                    <li><a href="{{ route('director.horario.index')}}"><i class="fa fa-clock-o"></i> Docente-Ayudante</a></li>
                    <li><a href="{{ route('director.horarioAlumno.index')}}"><i class="fa fa-clock-o"></i> Alumno</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('director.sala.index')}}"><i class="fa fa-list-alt"></i>Lista de Salas</a></li>
                <li><a href="{{ route('director.estacion.index')}}"><i class="fa fa-laptop"></i>Estaciones de Trabajo</a></li>
                <li><a href="{{ route('director.periodo.index')}}"><i class="fa fa-clock-o"></i> Períodos</a></li>
                <li><a href="{{ route('director.asignatura.index')}}"><i class="fa fa-pencil-square-o"></i> Asignaturas</a></li>
                <li><a href="{{ route('director.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
                <li><a href="{{ route('director.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/director/reportes_usuario')}}"><i class="fa fa-users"></i>Usuarios</a></li>
                <li><a href="{{ url('/director/reportes_sala')}}"><i class="fa fa-tv"></i>Salas</a></li>
                <li><a href="{{ url('/director/reportes_asignaturas')}}"><i class="fa  fa-book"></i>Asignaturas</a></li>
                <li><a href="{{ url('/director/reportes_fallas')}}"><i class="fa fa-exclamation-triangle"></i>Instrumentos dañados (Fallas)</a></li>
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
            <li><a href="{{ route('director.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
            <li><a href="{{ route('director.contacto.create')}}" target="_blank"><i class="fa fa-share"></i> <span>Enviar Correo</span></a></li>
          </ul>
@stop
@section('content')

  <div class="row">
    <div class="col-md-10 col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h2> Estadísticas Estaciones de Trabajo dañadas</h2>
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
                                Estaciones de Trabajo dañadas por Laboratorios
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="estdaña-chart"></div>
                                <hr style="margin-top: 15px; margin-bottom: 15px;"/>
                                <div id="dad" class="well"></div>
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
                <label for="sel1">Laboratorio </label>
                <select class="form-control" id="lab" name="lab">
                  @foreach($sala as $sal)
                    <option id="{{ $sal->id }}" value="{{ $sal->id }}" name="lab">{{ $sal->nombre }}</option>
                @endforeach
                </select>
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
    
    $("#fecha_inicio").datepicker();
    $("#fecha_termino").datepicker();
    var lab = $("#lab").val();

    column_chart('estdaña','','',lab);
    
  });

  $("#buscar").click(function(){

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_termino = $("#fecha_termino").val();
    var lab = $("#lab").val();

    column_chart('estdaña',fecha_inicio,fecha_termino,lab);
    daño('dañadas',lab);

  });

  function column_chart(tipo,fecha_inicio,fecha_termino,lab){

    if(tipo == 'estdaña')
    {
      nombre = 'Cantidad de Estaciones de Trabajo dañadas por Laboratorio'
      ejey = 'Estaciones dañadas'
      sub = ''
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
            text: sub
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
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
            pointFormat: 'Esatciones: <b>{point.y:.1f} dañadas</b>'
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

    $.getJSON("{{ route('director.reportes.repfalla') }}",{tipo: tipo,fecha_inicio: fecha_inicio, fecha_termino: fecha_termino, lab:lab}, function(json) {

        if (json.isError){

          $("#ErrorContent").removeClass('hide');
          $("#ErrorContent").html(json.message);
          //console.log(json);
          return;
        }

        $("#ErrorContent").addClass('hide');
        

        $.each(json,function(k,v){
            options.series[0].data.push(v);
        }); 

        chart = new Highcharts.Chart(options);

    });
  }   

  function daño(tipo,lab){


    $.getJSON("{{ route('director.reportes.repfalla') }}",{tipo: tipo, lab:lab}, function(json) {

        console.log(json);

       $("#dad").html("<strong>Laboratorio seleccionado: </strong>" + $("#lab option:selected").text() +"</br> <strong>Estación o Estaciones dañada(s): </strong> ");

        
        var count = Object.keys(json).length;
        
        if (count) {
          $.each(json,function(k,v){
            if (k == 0) {
              $("#dad").append(v);
            }
            else{
              $("#dad").append(" - "+v);
            }
          });           
        }else{
          $("#dad").append(0);
        }

    });
  }   
</script>


@stop


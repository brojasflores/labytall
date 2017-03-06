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
@section('content')

  <div class="row">
    <div class="col-md-10 col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h2> Estadísticas Salas</h2>
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
                                Cantidad de reservas de Laboratorios por Carrera
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="carrera-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cantidad de reservas de Docentes y Ayudantes por Período
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="maslabperinor-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>


                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cantidad de reservas de Alumnos por Período
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="maslabperialum-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cantidad de inasistencias de Docentes y Ayudantes por Período
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="menlabperinor-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>


                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Cantidad de inasistencias de Alumnos por Período
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="menlabperialum-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Laboratorio más usado por Docentes y Ayudantes
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="masusnor-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Laboratorio menos usado por Docentes y Ayudantes
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="menusnor-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Laboratorio más usado por Alumnos
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="masusalum-chart"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Laboratorio menos usado por Alumnos
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="menusalum-chart"></div>
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
                <select class="form-control" id="lab" name="lab" placeholder = "Seleccione:">
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

    column_chart('carrera','','');
    column_chart('maslabperinor','','');
    column_chart('maslabperialum','','');
    column_chart('menlabperinor','','');
    column_chart('menlabperialum','','');
    column_chart('masusnor','','');
    column_chart('menusnor','','');
    column_chart('masusalum','','');
    column_chart('menusalum','','');
    
  });

  $("#buscar").click(function(){

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_termino = $("#fecha_termino").val();
    var lab = $("#lab").val();

    column_chart('carrera',fecha_inicio,fecha_termino,lab);
    column_chart('maslabperinor',fecha_inicio,fecha_termino,lab);
    column_chart('maslabperialum',fecha_inicio,fecha_termino,lab);
    column_chart('menlabperinor',fecha_inicio,fecha_termino,lab);
    column_chart('menlabperialum',fecha_inicio,fecha_termino,lab);
    column_chart('masusnor',fecha_inicio,fecha_termino,lab);
    column_chart('menusnor',fecha_inicio,fecha_termino,lab);
    column_chart('masusalum',fecha_inicio,fecha_termino,lab);
    column_chart('menusalum',fecha_inicio,fecha_termino,lab);

  });

  function column_chart(tipo,fecha_inicio,fecha_termino,lab){

    if(tipo == 'carrera')
    {
      nombre = 'Asistencia de Carreras a los Laboratorios'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'maslabperinor')
    {
      nombre = 'Período en que Docentes y Ayudantes utilizan más un Laboratorio'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'maslabperialum')
    {
      nombre = 'Período en que Alumnos utilizan más un Laboratorio'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'menlabperinor')
    {
      nombre = 'Período en que Docentes y Ayudantes utilizan menos un Laboratorio'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'menlabperialum')
    {
      nombre = 'Período en que Alumnos utilizan menos un Laboratorio'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'masusnor')
    {
      nombre = 'Laboratorio más reservado por Docentes y Ayudantes'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'menusnor')
    {
      nombre = 'Laboratorio menos reservado por Docentes y Ayudantes'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'masusalum')
    {
      nombre = 'Laboratorio más reservado por Alumnos'
      ejey = 'Número de Reservas'
    }
    if(tipo == 'menusalum')
    {
      nombre = 'Laboratorio menos reservado por Alumnos'
      ejey = 'Número de Reservas'
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
            text: ''
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

    $.getJSON("{{ route('administrador.reportes.repsa') }}",{tipo: tipo,fecha_inicio: fecha_inicio, fecha_termino: fecha_termino, lab:lab}, function(json) {

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

</script>


@stop


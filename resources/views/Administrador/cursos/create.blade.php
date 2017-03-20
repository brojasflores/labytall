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
@section('opcion')
<li><a href="{{ route('administrador.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
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
<div class="row">
  <div class="col-xs-12">
    {!! Form::open(['action' => 'Administrador\cursoController@uploadCur','files'=>true]) !!}
      <div class="form-group">
        <div class="panel-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-md-2 control-label">Seleccione el archivo con los Crusos</label>
              <div class="col-md-4">
                <input type="file" class="form-control" name="file" >
              </div>
              <div class="col-md-4">
                <div align="center"<th><button type="submit" class="btn btn-success">Subir Cursos</button></th></div>
              </div>
            </div>
        </div>
       </div>
    {!! Form::close() !!}
  </div>
</div>

<form role="form" method="post" action="{{ route('administrador.curso.store')}}">
	<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	    	<div class="row">
	    	
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Asignatura: </label>
					  <select class="form-control" id="asignatura_id" name="asignatura_id">
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

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
          <div class="form-group">
            <label for="sel1">Docente: </label>
            <input type="text" id="docenteFilter" class="form-control" name="docenteFilter" value="" placeholder="Buscar Docente" />
            <select class="form-control" id="docentes" name="docentes">
              @foreach($docentes as $doc)
                <option value="{{ $doc->rut }}" name="docentes">{{ $doc->nombres}} - {{ $doc->apellidos}}</option>
              @endforeach
            </select>
          </div>
          </div>
        </div>
      </div>

      <div class="form-group">
            <label for="optradio">Ayudantía: </label>
            <div class="radio">
              <label><input type="radio" name="optradio" value="si">Sí</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="optradio" value="no">No</label>
            </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
          <div id="ayudantiacontent" class="form-group hide">
            <label for="sel1">Ayudante: </label>

            <input type="text" id="ayudantesFilter" class="form-control" name="ayudantesFilter" value="" placeholder="Buscar Ayudante" />
            <select class="form-control" id="ayudantes" name="ayudantes">
            <option value="" name="ayudantes">Seleccione</option>
              @foreach($ayudantes as $ayu)
                <option value="{{ $ayu->rut }}" name="ayudantes">{{ $ayu->nombres}} - {{ $ayu->apellidos}}</option>
              @endforeach
            </select>            
          </div>
          </div>
        </div>
      </div>


	    <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    //ayudantesFilter
    $('#ayudantes').filterByText($('#ayudantesFilter'));
    $('#docentes').filterByText($('#docenteFilter'));


/////
    $("#asignatura_id").change(function(){
            //alert($("#sala_id").val());
            var id = $("#asignatura_id").val();
            var token = $("#token").val();

            $.ajax({
              //url: '/~brojas/administrador/asignar_docente',
              url: '/~brojas/administrador/curso',
              headers:{'X-CSRF-TOKEN': token},
              type: 'POST',
              dataType: 'json',
              data:{asignatura_id : id},
              //response es la respuesta que trae desde el controlador
              success: function(response){ 



                $("#docentes").empty();
                $("#docentes").css('display','block');
                //el k es un índice (posición) y v (valor como tal del elemento)
                $.each(response.docentes,function(k,v){
                $("#docentes").append("<option value='"+v.rut+"' name='docentes'>"+v.nombres+" - "+v.apellidos+"</option>");
                });

                $("#ayudantes").empty();
                $("#ayudantes").css('display','block');
                //el k es un índice (posición) y v (valor como tal del elemento)
                $.each(response.ayudantes,function(k,v){
                $("#ayudantes").append("<option value='"+v.rut+"' name='ayudantes'>"+v.nombres+" - "+v.apellidos+"</option>");
                });
                
              }
            });

        });
//////

    
  });



   $('input[type=radio][name=optradio]').change(function() {
        if (this.value == 'si') {
            $("#ayudantiacontent").removeClass("hide");
        }
        else if (this.value == 'no') {
            $("#ayudantiacontent").addClass("hide");
        }
    });


      jQuery.fn.filterByText = function(textbox) {
          return this.each(function() {
              var select = this;
              var options = [];
              $(select).find('option').each(function() {
                  options.push({value: $(this).val(), text: $(this).text()});
              });
              $(select).data('options', options);

              $(textbox).bind('change keyup', function() {
                  var options = $(select).empty().data('options');
                  var search = $.trim($(this).val());
                  var regex = new RegExp(search,"gi");

                  $.each(options, function(i) {
                      var option = options[i];
                      if(option.text.match(regex) !== null) {
                          $(select).append(
                              $('<option>').text(option.text).val(option.value)
                          );
                      }
                  });
              });
          });
      };
</script>
@stop
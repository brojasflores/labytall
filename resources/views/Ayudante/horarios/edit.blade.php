@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('ayudante.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Ayudante</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('ayudante.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('ayudante.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('ayudante.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('ayudante.horario.index')}}"><i class="fa fa-clock-o"></i> Horarios</a></li>
<li class="active">Editar Horarios</li>
@stop
@section('content')
<h1>Editar Horario</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($horarios,['route' => ['ayudante.horario.update',$horarios], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	   
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Sala: </label>
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
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Permanencia: </label>
					  <select class="form-control" id="permanencia" name="permanencia">
					    	<option id="semestral" value="semestral" name="semestral">Semestral</option>
					    	<option id="dia" value="dia" name="dia">Día</option>
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
					    	<option id="lunes" value="lunes" name="dia">Lunes</option>
					    	<option id="martes" value="martes" name="dia">Martes</option>
					    	<option id="miercoles" value="miercoles" name="dia">Miércoles</option>
					    	<option id="jueves" value="jueves" name="dia">Jueves</option>
					    	<option id="viernes" value="viernes" name="dia">Viernes</option>
					    	<option id="sabado" value="sabado" name="dia">Sábado</option>					    						    	
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
					  <label for="sel1">Curso - Sección: </label>
					  <select class="form-control" id="curso_id" name="cursoHorario">
					  	@foreach($cursos as $curso)
					    	<option id="{{ $curso->id }}" value="{{ $curso->id }}" name="cursoHorario">{{ $curso->nombre }} - {{ $curso->seccion }}</option>
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
						  <input type="text" class="form-control" value="{{ $horarios->rut }}" name="rutHorario" id="rutHorario" aria-describedby="basic-addon2"> 
					</div>
		    	</div>
		    </div>
	    </div>	    
	    <input type="hidden" id="horario_id" value="{{ $horarios->id }}">
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
$( "#fecha_inicio" ).datepicker({
  showButtonPanel: true
});
$( "#fecha_fin" ).datepicker({
  showButtonPanel: true
});
} );

$(document).ready(function(){
	$.ajax({
		// con .val saco el valor del value
        data:  {'id': $("#horario_id").val(),'permanencia': $("#permanencia").val()},
        url:   '/~brojas/horario/'+$("#horario_id")+'/edit',
        type:  'get',
        dataType: 'json',
        success:  function(respuesta) {   
        console.log(respuesta);

        $('#sala_id option[id='+respuesta.horario[0].sala_id+']').attr('selected', 'selected');
		$('#periodo_id option[id='+respuesta.horario[0].periodo_id+']').attr('selected', 'selected');
		$('#curso_id option[id='+respuesta.horario[0].curso_id+']').attr('selected', 'selected'); 
		$('#permanencia option[id='+respuesta.horario[0].permanencia+']').attr('selected', 'selected');

        if($("#permanencia").val() == 'semestral')
		{

			$("#col-fecha").css('display','none');
			$("#col-dia").css('display','block');
			$("#col-fecha-ini").css('display','block');
			$("#col-fecha-fin").css('display','block');

			var date = (respuesta.fecha_inicio).split('-');
			var fecha_inicio = date[1] + '/' + date[2] + '/' + date[0];

			var date = (respuesta.fecha_fin).split('-');
			var fecha_fin = date[1] + '/' + date[2] + '/' + date[0];

			$("#fecha_inicio").val(fecha_inicio);
			$("#fecha_fin").val(fecha_fin);

			$('#dia option[id='+respuesta.dia+']').attr('selected', 'selected');
		}
		if($("#permanencia").val() == 'dia')
		{
			$("#col-fecha").css('display','block');
			$("#col-dia").css('display','none');
			$("#col-fecha-ini").css('display','none');
			$("#col-fecha-fin").css('display','none');

			var date = (respuesta.horario[0].fecha).split('-');
			var newDate = date[1] + '/' + date[2] + '/' + date[0];

			$("#fecha").val(newDate);
			$('#dia option[id='+respuesta.dia+']').attr('selected', 'selected');

		}

        }
    });
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
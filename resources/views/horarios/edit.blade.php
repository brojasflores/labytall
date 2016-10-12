@extends('main')
@section('opcion')
<li><a href="{{ route('horario.index')}}"><i class="fa fa-clock-o"></i> Horarios</a></li>
<li class="active">Editar Horarios</li>
@stop
@section('content')
<h1>Editar Horario</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($horarios,['route' => ['horario.update',$horarios], 'method' => 'PUT']) !!}
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
        url:   '/horario/'+$("#horario_id")+'/edit',
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

			$("#fecha_inicio").val(respuesta.fecha_inicio);
			$("#fecha_fin").val(respuesta.fecha_fin);

			$('#dia option[id='+respuesta.dia+']').attr('selected', 'selected');
		}
		if($("#permanencia").val() == 'dia')
		{
			$("#col-fecha").css('display','block');
			$("#col-dia").css('display','none');
			$("#col-fecha-ini").css('display','none');
			$("#col-fecha-fin").css('display','none');

			$("#fecha").val(respuesta.horario[0].fecha);
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
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
		   		  <label for="exampleInputEmail1">Fecha</label>
		      	  <input type="text" class="form-control" value="{{ $horarios->fecha}}" name="fechaHorario" id="fechaHorario" placeholder="Ingrese Fecha">
		      	</div>
	      	</div>
	    </div>
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
					    	<option value="semestral" name="semestral">Semestral</option>
					    	<option value="dia" name="dia">Día</option>
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

$(document).ready(function(){
	$.ajax({
		// con .val saco el valor del value
        data:  {'id': $("#horario_id").val()},
        url:   '/horario/'+$("#horario_id")+'/edit',
        type:  'get',
        dataType: 'json',
        success:  function(respuesta) {         
			$('#sala_id option[id='+respuesta.sala_id+']').attr('selected', 'selected');
			$('#periodo_id option[id='+respuesta.periodo_id+']').attr('selected', 'selected');
			$('#curso_id option[id='+respuesta.curso_id+']').attr('selected', 'selected');
        }
    });

});

</script>

@stop
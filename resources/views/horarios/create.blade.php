@extends('main')
@section('opcion')
<li><a href="{{ route('horario.index')}}"><i class="fa fa-clock-o"></i> Horarios</a></li>
<li class="active">Agregar Horarios</li>
@stop
@section('content')
<h1>Agregar Horario</h1>
<form role="form" method="post" action="{{ route('horario.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Fecha</label>
	      <input type="text" class="form-control" name="fechaHorario" id="fechaHorario" placeholder="Ingrese Fecha">
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Sala: </label>
					  <select class="form-control" id="sala_id" name="salaHorario">
					  	@foreach($salas as $sal)
					    	<option value="{{ $sal->id }}" name="salaHorario">{{ $sal->nombre }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>
		    </div>
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Bloque: </label>
					  <select class="form-control" id="periodo_id" name="periodoHorario">
					  	@foreach($periodos as $per)
					    	<option value="{{ $per->id }}" name="periodoHorario">{{ $per->bloque }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>
		    </div>
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Curso - Sección: </label>
					  <select class="form-control" id="curso_id" name="cursoHorario">
					  	@foreach($cursos as $curso)
					    	<option value="{{ $curso->id }}" name="cursoHorario">{{ $curso->nombre }} - {{ $curso->seccion }}</option>
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
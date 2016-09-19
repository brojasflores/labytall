@extends('main')
@section('opcion')
<li><a href="{{ route('curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
<li class="active">Agregar Cursos</li>
@stop
@section('content')
<h1>Agregar Curso</h1>
<form role="form" method="post" action="{{ route('curso.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">


	    <div class="form-group">
	    	<div class="row">
	    	
	    		<div class="col-md-2">
					<div class="form-group">
					  <label for="sel1">Asignatura: </label>
					  <select class="form-control" id="asignaturas" name="asigCurso">
					  	@foreach($asignaturas as $asig)
					    	<option value="{{ $asig->id }}" name="asigCurso">{{ $asig->nombre }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>
		    	
		    </div>
	    </div>

	    <div class="form-group">
	      <label for="exampleInputPassword1">Semestre</label>
	      <input type="text" class="form-control" name="semestreCurso" id="semestreCurso" placeholder="Ingrese semestre (Ej. 1, 2, 3)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Año</label>
	      <input type="text" class="form-control" name="anioCurso" id="anioCurso" placeholder="Ingrese año">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Sección</label>
	      <input type="text" class="form-control" name="seccionCurso" id="seccionCurso" placeholder="Ingrese sección (Ej. 1, 2, 3)">
	    </div>
	    <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
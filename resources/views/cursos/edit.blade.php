@extends('main')
@section('content')
<h1>Editar Curso</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($cursos,['route' => ['curso.update',$cursos], 'method' => 'PUT']) !!}
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
	      <input type="text" class="form-control" value="{{ $cursos->semestre}}" name="semestreCurso" id="semestreCurso" placeholder="Ingrese hora inicio período (Ej. 08:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Año</label>
	      <input type="text" class="form-control" value="{{ $cursos->anio}}" name="anioCurso" id="anioCurso" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Sección</label>
	      <input type="text" class="form-control" value="{{ $cursos->seccion}}" name="seccionCurso" id="seccionCurso" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
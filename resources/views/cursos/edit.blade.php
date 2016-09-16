@extends('main')
@section('content')
<h1>Editar Curso</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($cursos,['route' => ['curso.update',$cursos], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	    	<div class="row">
	    		@foreach($asignaturas as $asig)
	    		<div class="col-md-2">
			    	<div class="checkbox">
				    	<label><input type="radio" value="{!! $asig->id !!}" name="asigCurso">{!!$asig->nombre!!}</label>
			    	</div>
		    	</div>
		    	@endforeach
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
	    <button type="submit" class="btn btn-primary">Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
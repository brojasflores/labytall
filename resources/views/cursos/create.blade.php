@extends('main')
@section('content')
<h1>Agregar Curso</h1>
<form role="form" method="post" action="{{ route('curso.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">


	    <div class="form-group">
	    	<div class="row">
	    		@foreach($asignaturas as $asig)
	    		<div class="col-md-2">
			    	<div class="checkbox">
				    	<label><input type="radio" value="{!! $asig->id !!}" name="asigCurso">{!! $asig->nombre!!}</label>
			    	</div>
		    	</div>
		    	@endforeach
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
	    <button type="submit" class="btn btn-primary">Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
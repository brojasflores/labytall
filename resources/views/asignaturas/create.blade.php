@extends('main')
@section('content')
<h1>Agregar Asignatura</h1>
<form role="form" method="post" action="{{ route('asignatura.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Código</label>
	      <input type="text" class="form-control" name="codigoAsignatura" id="codigoAsignatura" placeholder="Ingrese código de la asignatura">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Nombre</label>
	      <input type="text" class="form-control" name="nombreAsignatura" id="nombreAsignatura" placeholder="Ingrese nombre de la asignatura">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Descripción</label>
	      <input type="text" class="form-control" name="descripcionAsignatura" id="descripcionAsignatura" placeholder="Ingrese descripción de la asignatura">
	    </div>
	    <button type="submit" class="btn btn-primary">Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
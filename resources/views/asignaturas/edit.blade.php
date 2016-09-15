@extends('main')
@section('content')
<h1>Editar Asignatura</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($asignaturas,['route' => ['asignatura.update',$asignaturas], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Código</label>
	      <input type="text" class="form-control" value="{{ $asignaturas->codigo}}" name="codigoAsignatura" id="codigoAsignatura" placeholder="Ingrese código de la asignatura">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Nombre</label>
	      <input type="text" class="form-control" value="{{ $asignaturas->nombre}}" name="nombreAsignatura" id="nombreAsignatura" placeholder="Ingrese nombre de la asignatura">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Descripción</label>
	      <input type="text" class="form-control" value="{{ $asignaturas->descripcion}}" name="descripcionAsignatura" id="descripcionAsignatura" placeholder="Ingrese descripción de la asignatura">
	    </div>
	    <button type="submit" class="btn btn-primary">Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
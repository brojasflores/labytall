@extends('main')
@section('content')
<h1>Agregar Rol</h1>
<form role="form" method="post" action="{{ route('rol.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Nombre Rol</label>
	      <input type="text" class="form-control" name="nombreRol" id="nombreRol" placeholder="Ingrese nombre del rol">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Descripción</label>
	      <input type="text" class="form-control" name="descripcionRol" id="descripcionRol" placeholder="Ingrese una descripción">
	    </div>
	    <button type="submit" class="btn btn-primary">Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
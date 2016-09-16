@extends('main')
@section('content')
<h1>Editar Rol</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($roles,['route' => ['rol.update',$roles], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Nombre Rol</label>
	      <input type="text" class="form-control" value="{{ $roles->nombre}}" name="nombreRol" id="nombreRol" placeholder="Ingrese nombre del rol">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Descripción</label>
	      <input type="text" class="form-control" value="{{ $roles->descripcion}}" name="descripcionRol" id="descripcionRol" placeholder="Ingrese una descripción">
	    </div>
	    <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
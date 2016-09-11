@extends('main')
@section('content')
<h1>Editar Usuario</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($usuario,['route' => ['usuario.update',$usuario], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Rut</label>
	      <input type="text" class="form-control" value="{{ $usuario->rut}}" name="rutUsuario" id="nombreSala" placeholder="Ingrese nombre">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Email</label>
	      <input type="text" class="form-control" value="{{ $usuario->email}}" name="emailUsuario" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Nombres</label>
	      <input type="text" class="form-control" value="{{ $usuario->nombres}}" name="nombresUsuario" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Apellidos</label>
	      <input type="text" class="form-control" value="{{ $usuario->apellidos}}" name="apellidosUsuario" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		@foreach($rolesTotales as $rol)
	    		<div class="col-md-2">
			    	<div class="checkbox">
				    	<!-- Para imprimir el valor de una variable hay que escribir como está aca-->
				    	<label><input type="checkbox" value="{!! $rol->id !!}" name="roles[]">{!! $rol->nombre !!}</label>
			    	</div>
		    	</div>
		    	@endforeach
		    </div>
	    </div>
	    <button type="submit" class="btn btn-primary">Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
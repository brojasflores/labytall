@extends('main')
@section('opcion')
<li><a href="{{ route('usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Agregar Usuarios</li>
@stop
@section('content')
<h1>Agregar Usuario</h1>
<form role="form" method="post" action="{{ route('usuario.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Rut</label>
	      <input type="text" class="form-control" name="rutUsuario" id="rutUsuario" placeholder="Ingrese Rut">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Email</label>
	      <input type="text" class="form-control" name="emailUsuario" id="emailUsuario" placeholder="Ingrese Email">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Nombres</label>
	      <input type="text" class="form-control" name="nombresUsuario" id="nombresUsuario" placeholder="Ingrese Nombres">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Apellidos</label>
	      <input type="text" class="form-control" name="apellidosUsuario" id="apellidosUsuario" placeholder="Ingrese Apellidos">
	    </div>
	    <div class="form-group">
	    	<div class="row">
	    		@foreach($roles as $rol)
	    		<div class="col-md-2">
			    	<div class="checkbox">
				    	<!-- Para imprimir el valor de una variable hay que escribir como está aca-->
				    	<label><input type="checkbox" value="{!! $rol->id !!}" name="roles[]">{!! $rol->nombre!!}</label>
			    	</div>
		    	</div>
		    	@endforeach
		    </div>
	    </div>
	    <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
@extends('main')
@section('opcion')
<li><a href="{{ route('usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Editar Usuarios</li>
@stop
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
	    	<div class="row" id="roles">
		   <!-- Aca van los roles que se llenan con jquery-->
		    </div>
	    </div>
	    <input type="hidden" id="usuario_id" value="{{ $usuario->id }}">
	    <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop

@section('scripts')
<script>

$(document).ready(function(){
	$.ajax({
		// con .val saco el valor del value
        data:  {'id': $("#usuario_id").val()},
        url:   '/usuario/'+$("#usuario_id")+'/edit',
        type:  'get',
        dataType: 'json',
        success:  function(respuesta) {          
	       	$.each(respuesta['roles'], function(k,v){
	       		//el # se refiere a una id
		       	$("#roles").append("<div class='col-md-2'><div class='checkbox'><label><input id='"+v.id+"' type='checkbox' value='"+v.id+"' name='roles[]'>"+v.nombre+"</label></div></div>");

	       		$.each(respuesta['roles_usuario'], function(key,value){
	       			if(value.rol_id == v.id)
		       			$("#"+v.id).prop("checked",true);
	       		});
	       	});

        }
    });

});

</script>

@stop
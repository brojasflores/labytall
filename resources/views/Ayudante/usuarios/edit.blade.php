@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('ayudante.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Ayudante</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('ayudante.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('ayudante.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-globe"></i> <span>Accesos Directos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="http://www.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Página Principal</a></li>
                <li><a href="http://mi.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Mi UTEM</a></li>
                <li><a href="http://postulacion.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> DIRDOC</a></li>
                <li><a href="http://reko.utem.cl/portal/" target="_blank"><i class="fa fa-external-link"></i> REKO</a></li>
                <li><a href="http://intranet.utem.cl/cb29be8b14c3c70e69672ae008310977/intranet/" target="_blank"><i class="fa fa-external-link"></i> Intranet</a></li>
                <li><a href="http://biblioteca.utem.cl/" target="_blank"><i class="fa fa-external-link"></i> Catálogo Biblioteca</a></li>
                <li><a href="http://bienestarestudiantil.blogutem.cl/" target="_blank"><i class="fa fa-external-link"></i> Bienestar Estudiantil</a></li>
              </ul>
            </li>
            <li><a href="{{ route('ayudante.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('opcion')
<li><a href="{{ route('ayudante.usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Editar Usuarios</li>
@stop
@section('content')
<h1>Editar Usuario</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($usuario,['route' => ['ayudante.usuario.update',$usuario], 'method' => 'PUT']) !!}
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
        url:   '/~brojas/usuario/'+$("#usuario_id")+'/edit',
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
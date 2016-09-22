@extends('main')
@section('opcion')
<li><a href="{{ route('sala.index')}}"><i class="fa fa-desktop"></i> Salas</a></li>
<li class="active">Editar Salas</li>
@stop
@section('content')
<h1>Editar Sala</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($sala,['route' => ['sala.update',$sala], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Nombre Sala</label>
	      <input type="text" class="form-control" value="{{ $sala->nombre}}" name="nombreSala" id="nombreSala" placeholder="Ingrese nombre">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Capacidad</label>
	      <input type="text" class="form-control" value="{{ $sala->capacidad}}" name="capacidadSala" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
	    </div>
	    <div class="form-group">
	      <!--label for="exampleInputPassword1">Disponibilidad</label-->
	      <!--input type="text" class="form-control" value="{{ $sala->disponibilidad}}" name="disponibilidadSala" id="disponibilidadSala" placeholder="Ingrese disponibilidad"-->
	      <label><input type="radio" value="disponible" name="disponibilidadSala" id="disponibilidadSala">Disponible</label>
	      <label><input type="radio" value="no disponible" name="disponibilidadSala" id="disponibilidadSala">No Disponible</label>
	      <label><input type="radio" value="dañado" name="disponibilidadSala" id="disponibilidadSala">Dañado</label>
	      <!--label><input type="radio" value="{{ $sala->disponibilidad}}" name="disponibilidadSala" id="dispobibilidadSala">Disponible</label-->
		  <!--input type="radio" value="{{ $sala->disponibilidad}}" name="disponibilidadSala" id="NodisponibilidadSala"> <label for="cbox2">No Disponible</label-->	
	    </div>
	    <button type="submit" class="fa fa-edit btn btn-primary"> Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
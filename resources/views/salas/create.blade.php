@extends('main')
@section('content')
<h1>Agregar Sala</h1>
<form role="form" method="post" action="{{ route('sala.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Nombre Sala</label>
	      <input type="text" class="form-control" name="nombreSala" id="nombreSala" placeholder="Ingrese nombre">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Capacidad</label>
	      <input type="text" class="form-control" name="capacidadSala" id="capacidadSala" placeholder="Ingrese cantidad alumnos">
	    </div>
	    <div class="form-group">
	      <!--label for="exampleInputPassword1">Disponibilidad</label>
	      <input type="text" class="form-control" name="disponibilidadSala" id="disponibilidadSala" placeholder="Ingrese disponibilidad"-->
			<label><input type="radio" name="disponibilidadSala" id="dispobibilidadSala" value="disponible">Disponible</label>
			<input type="radio" name="disponibilidadSala" id="NodisponibilidadSala" value="no_disponible"> <label for="cbox2">No Disponible</label>	
    	</div>
	    <button type="submit" class="btn btn-primary">Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
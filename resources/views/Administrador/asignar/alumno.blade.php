@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('options')
<h1>
    Salas 
  <small>Reserva Ayudante</small>
</h1>
@stop
@section('opcion')
<li><a href="{{ route('asignar.index')}}"><i class="fa fa-check-square-o"></i> Reserva</a></li>
<li class="active">Reserva Ayudante</li>
@stop
@section('content')
<div class="row" style="margin-left: 0px">

<form role="form" method="post" action="{{ route('asignar.store') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Salas: </label>
					  <select class="form-control" id="sala" name="sala">
					  	@foreach($salas as $sala)
					    	<option value="{{ $sala->id }}" name="sala">{{ $sala->nombre }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>		    	
		    </div>
	    </div>	
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Permanencia: </label>
					  <select class="form-control" id="permanencia" name="permanencia">
					  		<option value="0">Seleccione</option>
					    	<option value="dia" name="dia">Día</option>
					  </select>
					</div>
		    	</div>		    	
		    </div>
	    </div>	   
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3" id="col-fecha" style="display: none;">
					<div class="form-group">
					  <label for="sel1">Fecha: </label>
						  <input type="text" class="form-control" placeholder="Fecha" name="fecha" id="fecha" aria-describedby="basic-addon2">
					</div>
		    	</div>
	    		<div class="col-md-3" id="col-dia" style="display: none";>
					<div class="form-group">
					  <label for="sel1">Día: </label>
						<select class="form-control" id="dia" name="dia">
					    	<option value="lunes" name="dia">Lunes</option>
					    	<option value="martes" name="dia">Martes</option>
					    	<option value="miercoles" name="dia">Miércoles</option>
					    	<option value="jueves" name="dia">Jueves</option>
					    	<option value="viernes" name="dia">Viernes</option>
					    	<option value="sabado" name="dia">Sábado</option>					    						    	
					    </select>
					</div>
		    	</div>			    				    			    			    	
		    </div>
	    </div> 	
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Período: </label>
					  <select class="form-control" id="periodo" name="periodo">
					  	@foreach($periodos as $periodo)
					    	<option value="{{ $periodo->id }}" name="periodo">{{ $periodo->bloque }}</option>
						@endforeach
					  </select>
					</div>
		    	</div>		    	
		    </div>
	    </div>	
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Estaciones de Trabajo: </label>
					  		{{$capacidad}}
						  <!--input type="text" name="usuario" class="form-control" placeholder="12234123" aria-describedby="basic-addon2"-->
					</div>
		    	</div>
		    </div>
	    </div> 	   
	    <div class="form-group">
	    	<div class="row">
	    		<div class="col-md-3">
					<div class="form-group">
					  <label for="sel1">Rut Usuario: </label>
						  <input type="text" name="usuario" class="form-control" placeholder="12234123" aria-describedby="basic-addon2">
					</div>
		    	</div>
		    </div>
	    </div>	
		<button type="submit" class="fa fa-edit btn btn-primary">Reservar</button>
	</div>
</div>
@stop

@section('scripts')
  <script>

  $( function() {
    $( "#fecha" ).datepicker({
      showButtonPanel: true
    });
    $( "#fecha_inicio" ).datepicker({
      showButtonPanel: true
    });
    $( "#fecha_fin" ).datepicker({
      showButtonPanel: true
    });
  } );
  $(document).ready(function(){
	  $("#permanencia").change(function(){
	  	if($("#permanencia").val() == 'dia')
	  	{
	  		$("#col-fecha").css('display','block');
	  		$("#col-dia").css('display','none');
	  		$("#col-fecha-ini").css('display','none');
	  		$("#col-fecha-fin").css('display','none');
	  	}
	  });
	});
  </script>
@stop
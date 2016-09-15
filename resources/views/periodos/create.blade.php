@extends('main')
@section('content')
<h1>Agregar Período</h1>
<form role="form" method="post" action="{{ route('periodo.store')}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Bloque</label>
	      <input type="text" class="form-control" name="bloquePeriodo" id="bloquePeriodo" placeholder="Ingrese bloque (Ej. I, II, III)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Inicio</label>
	      <input type="text" class="form-control" name="inicioPeriodo" id="inicioPeriodo" placeholder="Ingrese hora inicio período (Ej. 08:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Fin</label>
	      <input type="text" class="form-control" name="finPeriodo" id="finPeriodo" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <button type="submit" class="btn btn-primary">Agregar</button>
	  </div><!-- /.box-body -->
</form>
@stop
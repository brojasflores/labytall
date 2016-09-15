@extends('main')
@section('content')
<h1>Editar Período</h1>
<!--variable del controlador, ruta donde lo quiero mandar y la variable y luego el metodo-->
{!! Form::model($periodos,['route' => ['periodo.update',$periodos], 'method' => 'PUT']) !!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <div class="box-body">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Bloque</label>
	      <input type="text" class="form-control" value="{{ $periodos->bloque}}" name="bloquePeriodo" id="bloquePeriodo" placeholder="Ingrese bloque (Ej. I, II, III)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Inicio</label>
	      <input type="text" class="form-control" value="{{ $periodos->inicio}}" name="inicioPeriodo" id="inicioPeriodo" placeholder="Ingrese hora inicio período (Ej. 08:00)">
	    </div>
	    <div class="form-group">
	      <label for="exampleInputPassword1">Fin</label>
	      <input type="text" class="form-control" value="{{ $periodos->fin}}" name="finPeriodo" id="finPeriodo" placeholder="Ingrese hora fin período (Ej. 21:00)">
	    </div>
	    <button type="submit" class="btn btn-primary">Editar</button>
	  </div><!-- /.box-body -->
{!! Form::close() !!}
@stop
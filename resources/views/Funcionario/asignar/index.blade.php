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
  <small>Reserva</small>
</h1>
@stop
@section('opcion')
<li class="active">Reserva</li>
@stop
@section('content')
<div class="jumbotron">
  <h1>¡Bienvenido a la reserva de Salas!</h1>
  </br></br>
  <center>
    <form role="form" method="get" action="{{ route('horario.index')}}">
      <button type="submit" class="fa fa-eye btn btn-primary"> Ver horarios</button>
    </form>
  </center>
  </br></br>
  <p>En este módulo usted podrá reservar salas a Docentes, Ayudantes y Alumnos.</p>
  </br></br>
  <div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8 col-md-offset-3">
      <!--div class="form-group"-->
        <a href="{{URL::to('/asignar_docente')}}" class="btn btn-primary btn-lg" role="button">Reserva Docentes</a>
        <a href="{{URL::to('/asignar_ayudante') }}" class="btn btn-primary btn-lg" role="button">Reserva Ayudantes</a>
        <a href="{{URL::to('/asignar_alumno') }}" class="btn btn-primary btn-lg" role="button">Reserva Alumnos</a>
        <!--div class="btn btn-primary btn-lg" href="#" role="button">Reserva Alumnos</div-->
      <!--/div-->
    </div>        
</div>  
</div>
@stop




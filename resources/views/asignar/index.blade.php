@extends('main')
@section('opcion')
<li class="active">Asignación</li>
@stop
@section('content')
<div class="jumbotron">
  <h1>¡Bienvenido a la asignación de Salas!</h1>
  </br></br>
  <p>En este módulo usted podrá asignar salas a Docentes, Ayudantes y Alumnos.</p>
  </br></br>
  <div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8 col-md-offset-3">
      <!--div class="form-group"-->
         <a href="{{URL::to('/asignar_docente')}}" class="btn btn-primary btn-lg" role="button">Asignación Docentes</a>
         <a href="{{URL::to('/asignar_ayudante') }}" class="btn btn-primary btn-lg" role="button">Asignación Ayudantes</a>
        <div class="btn btn-primary btn-lg" href="#" role="button">Asignación Alumnos</div>
      <!--/div-->
    </div>        
</div>  
</div>
@stop




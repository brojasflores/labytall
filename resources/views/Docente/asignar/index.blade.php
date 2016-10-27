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
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Docente</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
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



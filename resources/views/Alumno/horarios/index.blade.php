@extends('main')
@section('cambioRol')
<style type="text/css">
.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 197px;
}
.dropdown-menu>li>a {
    color: #333;
}
.navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
   margin-top: 0px;
}
p {
    margin: 0 0 5px;
}
hr {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>
  @if($cont>1)
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <img src="{{asset('admin-lte/dist/img/cambio.png')}}" class="user-image" alt="User Image">
      <span class="hidden-xs">Cambio Rol</span>
    </a>
    <ul class="dropdown-menu">
      <li class="user-header">
        <p>
          Elija el Rol que quiera utilizar
        </p>
        @foreach($v2 as $as)
          @if($as == 'administrador')
            <a href="{{ route('administrador..index')}}"><i class="fa fa-mail-forward"></i> Administrador</a>
          @endif
          @if($as == 'director')
            <a href="{{ route('director..index')}}"><i class="fa fa-mail-forward"></i> Director</a>
          @endif
          @if($as == 'funcionario')
            <a href="{{ route('funcionario..index')}}"><i class="fa fa-mail-forward"></i> Funcionario</a>
          @endif
          @if($as == 'docente')
            <a href="{{ route('docente..index')}}"><i class="fa fa-mail-forward"></i> Docente</a>
          @endif
          @if($as == 'ayudante')
            <a href="{{ route('ayudante..index')}}"><i class="fa fa-mail-forward"></i> Ayudante</a>
          @endif
          @if($as == 'alumno')
            <a href="{{ route('alumno..index')}}"><i class="fa fa-mail-forward"></i> Alumno</a>
          @endif
        @endforeach
      </li>
    </ul>
  </li>
@endif
@stop
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('alumno.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Alumno</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('alumno.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('alumno.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('alumno.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('options')
<h1>
    Salas 
  <small>Ver horarios</small>
</h1>
@stop
@section('opcion')
<li class="active">Horarios</li>
@stop
@section('content')
<h1>Horarios</h1>
<form role="form" method="get" action="{{ route('alumno.asignar.index')}}">
  <button type="submit" class="fa fa-plus-square btn btn-primary"> Realizar una Reserva</button>
</form>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Sala</th>
                <th>Período</th>
                <th>Curso</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Permanencia</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($horarios as $hr)
              <tr data-id="{{ $hr->id }}">
                <td>{{ $hr->id }}</td>
                <td>{{ $hr->fecha }}</td>
                <td>{{ $hr->sala_nombre}}</td>
                <td>{{ $hr->bloque}}</td>
                <td>{{ $hr->asig_nombre}}</td>
                <td>{{ $hr->horario_name}} {{ $hr->horario_apell}}</td>
                <td>{{ $hr->rut}}</td>  
                <td>{{ $hr->permanencia}}</td>
                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('alumno.horario.edit',$hr->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['alumno.horario.destroy', $hr->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                  <button type="submit" class="fa fa-trash btn btn-danger"> Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Sala</th>
                <th>Período</th>
                <th>Curso</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Permanencia</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </tfoot>
          </table>
          {{ $horarios->render()}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@stop

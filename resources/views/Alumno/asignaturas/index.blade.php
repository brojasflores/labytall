@extends('main')
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
  <small>Asignaturas</small>
</h1>
@stop
@section('opcion')
<li class="active">Asignaturas</li>
@stop
@section('content')
<h1>Asignaturas</h1>
<form role="form" method="get" action="{{ route('alumno.asignatura.create')}}">
  <button type="submit" class="fa fa-plus-square btn btn-primary"> Agregar</button>
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
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($asignaturas as $as)
              <tr data-id="{{ $as->id }}">
                <td>{{ $as->id }}</td>
                <td>{{ $as->codigo }}</td>
                <td>{{ $as->nombre}}</td>
                <td>{{ $as->descripcion}}</td>

                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('alumno.asignatura.edit',$as->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['alumno.asignatura.destroy', $as->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                  <button type="submit" class="fa fa-trash btn btn-danger"> Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@stop
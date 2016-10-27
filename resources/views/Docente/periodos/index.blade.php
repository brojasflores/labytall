@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('docente.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
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
                <li><a href="{{ route('docente.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <li><a href="{{ route('docente.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
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
            <li><a href="{{ route('docente.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
          </ul>
@stop
@section('options')
<h1>
    Salas 
  <small>Períodos</small>
</h1>
@stop
@section('opcion')
<li class="active">Períodos</li>
@stop
@section('content')
<h1>Períodos</h1>
<form role="form" method="get" action="{{ route('docente.periodo.create')}}">
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
                <th>Bloque</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($periodos as $per)
              <tr data-id="{{ $per->id }}">
                <td>{{ $per->id }}</td>
                <td>{{ $per->bloque }}</td>
                <td>{{ $per->inicio}}</td>
                <td>{{ $per->fin}}</td>

                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('docente.periodo.edit',$per->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['docente.periodo.destroy', $per->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                  <button type="submit" class="fa fa-trash btn btn-danger"> Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Bloque</th>
                <th>Inicio</th>
                <th>Fin</th>
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
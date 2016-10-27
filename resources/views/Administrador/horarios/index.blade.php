@extends('main')
@section('perfil')
<li class="user-footer">
  <div class="pull-left">
    <a href="{{route('administrador.usuario.perfil',['id' => Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
  </div>
  <div class="pull-right">
    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
  </div>
</li>
@stop
@section('menu')
<ul class="sidebar-menu">
            <li class="header">Administración</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Gestión Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <!--Controlador.metodo-->
                <li><a href="pages/usuarios/admin.html"><i class="glyphicon glyphicon-barcode"></i> Autenticación</a></li>
                <li><a href="{{ route('administrador.usuario.index')}}"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="{{ route('administrador.rol.index')}}"><i class="fa fa-wrench"></i> Roles</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-desktop"></i> <span>Salas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('administrador.horario.index')}}"><i class="fa fa-eye"></i> Ver horarios</a></li>
                <!--route ruta del controlador.metodo-->
                <li><a href="{{ route('administrador.sala.index')}}"><i class="fa fa-list-alt"></i>Lista de Salas</a></li>
                <li><a href="{{ route('administrador.periodo.index')}}"><i class="fa fa-clock-o"></i> Períodos</a></li>
                <li><a href="{{ route('administrador.asignatura.index')}}"><i class="fa fa-pencil-square-o"></i> Asignaturas</a></li>
                <li><a href="{{ route('administrador.curso.index')}}"><i class="glyphicon glyphicon-education"></i> Cursos</a></li>
                <li><a href="{{ route('administrador.asignar.index')}}"><i class="fa fa-check-square-o"></i> Reservar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/labs/admin.html"><i class="fa fa-users"></i>Usuarios</a></li>
                <li><a href="pages/labs/admin.html"><i class="fa fa-tv"></i>Salas</a></li>
                <li><a href="pages/labs/docente.html"><i class="fa fa-hand-pointer-o"></i>Usabilidad</a></li>
                <li><a href="pages/labs/ayudante.html"><i class="fa  fa-book"></i>Asignaturas</a></li>
                <!--li><a href="pages/labs/alumno.html"><i class="fa fa-calendar"></i>Fechas</a></li-->
                <li class="active"><a href="javascript:void(0);" onclick="cargarlistado(4);" ><i class="fa fa-calendar"></i>Fechas</a></li>
                <li><a href="pages/labs/alumno.html"><i class="fa fa-exclamation-triangle"></i>Instrumentos dañados (Fallas)</a></li>
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
            <li><a href="{{ route('administrador.contacto.index')}}" target="_blank"><i class="fa fa-envelope"></i> <span>Contáctenos</span></a></li>
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
<form role="form" method="get" action="{{ route('administrador.asignar.index')}}">
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
                <td><a href="{{ route('administrador.horario.edit',$hr->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['administrador.horario.destroy', $hr->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
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

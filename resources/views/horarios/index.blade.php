@extends('main')
@section('opcion')
<li class="active">Horarios</li>
@stop
@section('content')
<h1>Horarios</h1>
<form role="form" method="get" action="{{ route('horario.create')}}">
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
                <th>Fecha</th>
                <th>Sala</th>
                <th>Período</th>
                <th>Curso</th>
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

                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('horario.edit',$hr->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['horario.destroy', $hr->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
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
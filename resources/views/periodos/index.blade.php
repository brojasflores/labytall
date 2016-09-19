@extends('main')
@section('opcion')
<li class="active">Períodos</li>
@stop
@section('content')
<h1>Períodos</h1>
<form role="form" method="get" action="{{ route('periodo.create')}}">
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
                <td><a href="{{ route('periodo.edit',$per->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['periodo.destroy', $per->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
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
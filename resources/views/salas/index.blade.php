@extends('main')
@section('content')

<form role="form" method="get" action="{{ route('sala.create')}}">
	<button type="submit" class="btn btn-primary">Agregar</button>
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
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($salas as $sa)
              <tr data-id="{{ $sa->id }}">
              	<td>{{ $sa->id }}</td>
                <td>{{ $sa->nombre }}</td>
                <td>{{ $sa->capacidad}}</td>
                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('sala.edit',$sa->id)}}"><i class="fa fa-edit"></i></a></td>
                <td>
                {!! Form::open(['route' => ['sala.destroy', $sa->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                	<button type="submit" class="btn btn-danger">Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Editar</th>
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
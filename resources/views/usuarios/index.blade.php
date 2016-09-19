@extends('main')
@section('opcion')
<li class="active">Usuarios</li>
@stop
@section('content')
<h1>Usuarios</h1>
<form role="form" method="get" action="{{ route('usuario.create')}}">
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
                <th>Rut</th>
                <th>Email</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($usuarios as $usr)
              <tr data-id="{{ $usr->id }}">
              	<td>{{ $usr->id }}</td>
                <td>{{ $usr->rut}}</td>
                <td>{{ $usr->email}}</td>
                <td>{{ $usr->nombres}}</td>
                <td>{{ $usr->apellidos}}</td>
                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('usuario.edit',$usr->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <!--<td><a href="{{ route('usuario.edit',$usr->id)}}"><i class="fa fa-edit"></i></a></td>-->
                <td>
                {!! Form::open(['route' => ['usuario.destroy', $usr->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                	<button type="submit" class="fa fa-trash btn btn-danger"> Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Rut</th>
                <th>Email</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </tfoot>
          </table>
          <!--cuando se usa paginate debo poner esto-->
              {{ $usuarios->render()}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@stop
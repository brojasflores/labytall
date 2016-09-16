@extends('main')
@section('content')
<h1>Cursos</h1>
<form role="form" method="get" action="{{ route('curso.create')}}">
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
                <th>Asignatura</th>
                <th>Semestre</th>
                <th>Año</th>
                <th>Sección</th>
                <th>Editar </th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
          <!--foreach recorre una coleccion de objetos-->
              @foreach($cursos as $cur)
              <tr data-id="{{ $cur->id }}">
                <td>{{ $cur->id }}</td>
                <td>{{ $cur->nombre }}</td>
                <td>{{ $cur->semestre}}</td>
                <td>{{ $cur->anio}}</td>
                <td>{{ $cur->seccion}}</td>

                <!--Paso ruta y parametro para saber cual modificar-->
                <td><a href="{{ route('curso.edit',$cur->id)}}"><button type="submit" class="fa fa-edit btn btn-edit"> Editar</button></a></td>
                <td>
                {!! Form::open(['route' => ['curso.destroy', $cur->id], 'method' => 'DELETE', 'id' => 'form-delete'])!!}
                  <button type="submit" class="fa fa-trash btn btn-danger"> Eliminar</button>
                {!! Form::close() !!}
                </td>    
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Asignatura</th>
                <th>Semestre</th>
                <th>Año</th>
                <th>Sección</th>
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
@extends('main')
@section('options')
<h1>
    Gestión Usuarios 
  <small>Usuarios</small>
</h1>
@stop
@section('opcion')
<li><a href="{{ route('usuario.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
<li class="active">Perfil Usuario</li>
@stop
@section('content')
<h1>Perfil Usuario</h1>
<h2>Cambiar imagen de perfil</h2>
<form method='post' action='{{url("usuario_perfilUpdate")}}' enctype='multipart/form-data'>
  {{csrf_field()}}
  <div class='form-group'>
    <label for='image'>Imagen: </label>
    <input type="file" name="image" />
    <div class='text-danger'>{{$errors->first('image')}}</div>
  </div>
  <button type='submit' class='btn btn-primary'>Actualizar imagen de perfil</button>
</form>

@stop
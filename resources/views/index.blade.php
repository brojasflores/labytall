@extends('main')
@section('options')
<h1>
    Panel de Control 
	<small>Inicio</small>
</h1>
@stop
@section('content')
<div class="container" style="padding-left: 0px;">
<h1><img src="{{ asset('admin-lte/dist/img/utem.png') }}" class="user-image" alt="User Image" border="0" width="40" height="40"> Sistema Control y Gestión Salas UTEM </h1>
</br>
<center>
    <h2>¡¡BIENVENIDO!!</h2>
	<img src="{{ asset('admin-lte/dist/img/aula.png') }}" class="user-image" alt="User Image" border="0" width="300" height="200">
  	<p>¡Ha iniciado sesión satisfactoriamente!</p>
</center>
</div>
@stop


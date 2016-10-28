<!DOCTYPE html>
<!--@if(Session::has('message'))

          <div class="alert alert-info" role="alert">
           <strong class="alert-link">{{ Session::get('message') }}</strong>
          </div>       
@endif-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestión Salas | Perfil</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin-lte/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/iCheck/square/blue.css')}}">
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <span class="logo-mini"><img src="{{ asset('admin-lte/dist/img/utem.png') }}" class="user-image" alt="User Image" border="0" width="80" height="80"></span>
        <br>
        <a href="{{ asset('admin-lte/index2.html')}}"><b>Gestión Salas</b></a>
      </div>

      <div class="main-contact">
        <h3>Perfil Usuario</h3>
		<h4>Actualiza tus datos</h4>

        <form method='post' action='{{url("docente/usuario_perfilUpdate")}}' enctype='multipart/form-data'>
        	{{csrf_field()}}
          <div class="form-group has-feedback">
            <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="emailUsuario" id="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" value="{{ Auth::user()->nombres }}" name="nombres" placeholder="Nombres">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" "{{ Auth::user()->apellidos }}" name="apellidos" placeholder="Apellidos">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="row">
		  	<div class="col-md-4">
			  <div class='form-group'>
			    <label for='image'>Imagen: </label>
			    <input type="file" name="image" />
			    <div class='text-danger'>{{$errors->first('image')}}</div>
			  </div>
			</div>
		</div>
          <div class="row">
            <div class="col-xs-5">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar Datos</button>
            </div><!-- /.col -->
          </div>
        <!--/form-->
       </form>
      </div><!-- /.form-box -->

    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin-lte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('admin-lte/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('admin-lte/plugins/iCheck/icheck.min.js')}}"></script>
    
  </body>
</html>


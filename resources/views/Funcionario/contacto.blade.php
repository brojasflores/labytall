<!DOCTYPE html>

@if(Session::has('message'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="alert-link">{{ Session::get('message') }}</strong>
    </div>
@endif
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestión Salas | Contáctenos</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
   <div class="register-logo">
        <span class="logo-mini"><img src="{{ asset('admin-lte/dist/img/utem.png') }}" class="user-image" alt="User Image" border="0" width="80" height="80"></span>
        <br>
        <a href="{{ asset('admin-lte/index2.html')}}"><b>Gestión Salas</b></a>
      </div>

      <div class="main-contact">
        <p class="login-box-msg">Contáctenos</p>
        {!! Form::model(['route' => ['funcionario.contacto.store'], 'method' => 'PUT']) !!}
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="nombreContacto" placeholder="Nombre">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="emailContacto" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <textarea type="text" class="form-control" name="mensajeContacto" placeholder="Mensaje"></textarea>
            <span class="glyphicon glyphicon-comment form-control-feedback"></span>
          </div>
          <input type="hidden" name="tipo" value="contactenos">
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
            </div><!-- /.col -->
          </div>
        <!--/form-->

        {!! Form::close() !!}
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

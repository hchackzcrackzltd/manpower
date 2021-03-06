<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}} | Error 400</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('css/user.min.css')}}">
  <!-- Bootstrap 3.3.6 -->
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <![endif]-->
  <style media="screen">
    textarea{
      resize: vertical;
    }
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{route('user_dashboard')}}" class="navbar-brand"><b>Manpower</b> Requisition</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <i class="fa fa-warning"></i> Error 400
          <small>Error 400</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('user_dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="error-page">
              <h2 class="headline text-yellow"> 404</h2>
              <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                <p>
                  We could not find the page you were looking for.
                  Meanwhile, you may <a href="{{route('user_dashboard')}}">return to dashboard</a>.
                </p>
              </div>
              <!-- /.error-content -->
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
      </div>
      <strong>Copyright &copy; 2014-2017 <a href="#">DoDayDream PLC</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('js/user.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<!-- SlimScroll -->
<!-- FastClick -->
<!-- AdminLTE App -->
<script>
$('input[type=number]').on('keypress', function(event) {
  (event.which>47&&event.which<58)?null:event.preventDefault();
});
$('div').on('keypress','input[type=number]', function(event) {
  (event.which>47&&event.which<58)?null:event.preventDefault();
});
  $('input[type=checkbox],input[type=radio]').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green'
  });
</script>
</body>
</html>

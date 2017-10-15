<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}} | @yield('titlepage')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('css/user.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- Bootstrap 3.3.6 -->
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <!-- Theme style -->
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
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{route('user_dashboard')}}"><i class="fa fa-dashboard"></i> Request Status <span class="sr-only">(current)</span></a></li>
            @can('acman',$auman)
              <li><a href="{{route('manpowerreq.index')}}"><i class="fa fa-user"></i> Manpower Form</a></li>
            @endcan
            @can('acrgn',$aursg)
              <li><a href="{{route('resignreq.index')}}"><i class="fa fa-user-times"></i> Resign Form</a></li>
            @endcan
            <li>
              @can('acapp',$auapp)
              <a href="{{route('approveu.index')}}" title="Approve"><i class="fa fa-check-circle"></i> Approve</span></a>
              @endcan
            </li>
            <li>
              <a href="{{route('candidatesh.index')}}" title="Search Candidate"><i class="fa fa-users"></i> Candidate</span></a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- /.messages-menu -->
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"></span>
                  {{auth()->user()->name}}
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{asset('adminlte/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">

                  <p>
                      {{auth()->user()->name}}
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
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
          @yield('title')
          <small>@yield('subtitle')</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('user_dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          @yield('breadcrumb')
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-6 col-lg-4 pull-right">
            @foreach ($errors->all() as $message)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                {{$message}}
              </div>
            @endforeach
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                {{session('success')}}
              </div>
            @endif
          </div>
        </div>
        @yield('content')
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
@yield('script')
</body>
</html>

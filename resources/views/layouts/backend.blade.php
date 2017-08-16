<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">--}}
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Ionicons -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">--}}
    <link href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}" >

    @yield('stylesheet')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('backend/' )}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>F</b>L</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Fenglei</b>&nbsp;Blog</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('uploads/avatar')."/".Auth::user()->user_pic }}" class="user-image" alt="User Image">
                            <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('uploads/avatar')."/".Auth::user()->user_pic }}" class="img-circle" alt="User Image">

                                <p>
                                    Feng Lei Blog - 做努力的自己
                                    {{--<small></small>--}}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/') }}" target="_blank" class="btn btn-default btn-flat">首页</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('backend/logout') }}" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            @inject('backendPresenter', 'App\Presenters\BackendPresenter')
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('uploads/avatar')."/".Auth::user()->user_pic }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class='sidebar-menu'>
                {!! $backendPresenter->menu()  !!}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('header')
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="{{ asset('AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/app.min.js') }}"></script>

<script src="{{ asset('layer/layer.js') }}" ></script>

<script src="{{ asset('bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}" ></script>

<script src="{{ asset('js/moell.js') }}" ></script>

<script src="{{ asset('js/backend.js') }}" ></script>

@yield('javascript')
</body>
</html>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="author" content="Moell" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('default/css/bootstrap.min.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('default/css/animate.css') }}">

    @yield('style')

    <link rel="stylesheet" href="{{ asset('default/css/index.css') }}">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
@inject('systemPresenter', 'App\Presenters\SystemPresenter')
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url("/") }}" >{{ $systemPresenter->getKeyValue('blog_name') }}</a>
        </div>
        @include('default.navigation')
    </div>
</nav>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <p>
            @yield('header-text')
        </p>
    </div>
</div>

<div class="container">
    <div class='row'>
        <div class='col-md-8' >
            @yield('content')
        </div>
        <div class='col-md-4'>
            @include('default.author')

            @include('default.tag')

            @include('default.hot')

            @include('default.link')
        </div>
    </div>
</div> <!-- /container -->


@include('default.footer')

<!-- jQuery -->
<script src="{{ asset('default/js/jQuery-2.2.0.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('default/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->

<script src="{{ asset('default/js/index.js') }}"></script>

@yield('script')
</body>
</html>

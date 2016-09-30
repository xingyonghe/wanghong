<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>AdminX</title>

    <!--common-->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
    @yield('styles')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

<section>
    @include('admin.layouts.left')
    <!-- main content start-->
    <div class="main-content" >
        <section class="panel" style="margin-bottom: 0px; ">
            <div class="panel-body">
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Success</strong>{{Session::get('success')}}
                    </div>
                @endif
                @if($errors->has('status'))
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Error</strong> {{$errors->first('error')}}
                    </div>
                @endif
            </div>
        </section>
        @include('admin.layouts.nav')
        @yield('content')
        @include('admin.layouts.footer')
    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/assets/js/jquery-1.10.2.min.js"></script>
<script src="/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/modernizr.min.js"></script>
<script src="/assets/js/jquery.nicescroll.js"></script>
<script src="/static/layer/layer.js"></script>

<!--common scripts for all pages-->
<script src="/assets/js/scripts.js"></script>
<script src="/js/header_active.js"></script>
<script>
    $(function(){
        checked_admin_header_nav('.custom-nav .three-menu-list .sub-menu-list li a','admin');
    });
</script>
{{--页面附加js--}}
@yield('scripts')

</body>
</html>

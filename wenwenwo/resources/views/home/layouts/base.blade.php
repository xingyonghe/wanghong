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

    <!--icheck-->
    <link href="/assets/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="/assets/js/iCheck/skins/square/square.css" rel="stylesheet">
    <link href="/assets/js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="/assets/js/iCheck/skins/square/blue.css" rel="stylesheet">

    <!--dashboard calendar-->
    <link href="/assets/css/clndr.css" rel="stylesheet">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="/assets/js/morris-chart/morris.css">

    <!--common-->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">
    @yield('styles')
    <style>
        .sub-menu-list > li.nav-active > a {
            background-color: #353f4f;
            background-image: url(../images/minus.png);
            color: #65cea7;
        }
    </style>


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

<!--easy pie chart-->
<script src="/assets/js/easypiechart/jquery.easypiechart.js"></script>
<script src="/assets/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="/assets/js/sparkline/jquery.sparkline.js"></script>
<script src="/assets/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="/assets/js/iCheck/jquery.icheck.js"></script>
<script src="/assets/js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="/assets/js/flot-chart/jquery.flot.js"></script>
<script src="/assets/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/assets/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="/assets/js/morris-chart/morris.js"></script>
<script src="/assets/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="/assets/js/calendar/clndr.js"></script>
<script src="/assets/js/calendar/evnt.calendar.init.js"></script>
<script src="/assets/js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="/assets/js/scripts.js"></script>

<!--Dashboard Charts-->
<script src="/assets/js/dashboard-chart-init.js"></script>
{{--页面附加js--}}
@yield('scripts')

</body>
</html>

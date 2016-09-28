<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>404</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admin-assets/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('admin-assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('admin-assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="body-404">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-404"></i>
        <h1>404</h1>
        <h2>页面不存在</h2>
        <p class="page-404">一些错误或页面不存在。 <a href="{{ url('admin/index/index') }}">返回 Home</a></p>
    </section>

</div>


</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>404 Page</title>

    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="error-page">

<section>
    <div class="container ">

        <section class="error-wrapper text-center">
            <h1><img alt="" src="/assets/images/404-error.png"></h1>
            <h2>page not found</h2>
            <h3>{{$exception->getMessage()}}</h3>
            <a class="back-btn" href="javascript:window.history.back(-1);"> Back To Home</a>
        </section>

    </div>
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/assets/js/jquery-1.10.2.min.js"></script>
<script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/modernizr.min.js"></script>


<!--common scripts for all pages-->
<!--<script src="js/scripts.js"></script>-->

</body>
</html>
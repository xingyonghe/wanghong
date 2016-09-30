<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Registration</title>

    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">
    @include('admin.public.errors')
    <form class="form-signin" action="{{url('admin/public/register')}}" method="post">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Registration</h1>
            <img src="/assets/images/login-logo.png" alt=""/>
        </div>


        <div class="login-wrap">
            <p> Enter your account details below</p>
            {!! csrf_field() !!}
            <input type="text" autofocus="" placeholder="登录账户" class="form-control">
            <input type="password" placeholder="登录密码" class="form-control">
            <input type="password" placeholder="确认密码" class="form-control">
            <label class="checkbox">
                <input type="checkbox" value="agree this condition"> I agree to the Terms of Service and Privacy Policy
            </label>
            <button type="submit" class="btn btn-lg btn-login btn-block">
                <i class="fa fa-check"></i>
            </button>

            <div class="registration">
                Already Registered.
                <a href="login.html" class="">
                    Login
                </a>
            </div>

        </div>

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/assets/js/jquery-1.10.2.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/modernizr.min.js"></script>

</body>
</html>

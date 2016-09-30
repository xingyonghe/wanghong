<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>{{config('admin_config.SITE_TITLE')}}</title>

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
    <form class="form-signin" action="{{url('admin/public/login')}}" method="post" id="login_form">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">登录</h1>
            <img src="/assets/images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            {!! csrf_field() !!}
            <input type="text" class="form-control" name="username" placeholder="用户名" autofocus>
            <input type="password" class="form-control" name="password" placeholder="密码">

            <button class="btn btn-lg btn-login btn-block submit_btn" type="button">
                登录
            </button>
            <div class="registration">
                Not a member yet?
                <a class="" href="{{url('admin/public/register')}}">
                    Signup
                </a>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>

        </div>


    </form>

</div>

<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/assets/js/jquery-1.10.2.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/modernizr.min.js"></script>
<script src="/static/new_layer/layer.js"></script>
<script>
    $('.submit_btn').click(function(){
        var _form_info = $('#login_form').serialize();
        var _url = $('#login_form').attr('action');
        $.post(_url,_form_info,function(data){
            if(data['status'] > 0){
                layer.alert(data['info'],function(){
                    window.location.href="{{url('admin')}}";
                });
            }else{
                layer.msg(data['info'],{icon:2});
            }
        },'json');
    })
</script>

</body>
</html>

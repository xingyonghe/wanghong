<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <title>网红后台管理系统</title>
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

<body class="login-body">

<div class="container">
    {!! Form::open(['url' => 'admin/login','class'=>'form-signin']) !!}
        <h2 class="form-signin-heading">管理系统</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="请输入管理员账号" name="username" value="{{ old('username') }}">
            @if ($errors)
                <p class="help-block">{{ $errors->first() }}</p>
            @endif
            <input type="password" class="form-control" placeholder="请输入密码" name="password">
            <button class="btn btn-lg btn-login btn-block" type="submit">登 录</button>
        </div>
    {!!Form::close()!!}
</div>


</body>
</html>

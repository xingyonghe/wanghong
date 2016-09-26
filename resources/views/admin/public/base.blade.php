<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>网红后台管理系统</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admin-assets/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('admin-assets/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-assets/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    @yield('style')
</head>
<body>
<section id="container" class="">
    @include('admin.public.head')
    @include('admin.public.menu')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div id="top-alert" class="alert alert-block alert-danger fade in" style="display:none;position: fixed;width:89.11%;z-index: 555">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <strong class="msg" style="margin-right: 25px">Oh Warning !</strong><span class="message"></span>
            </div>
            @if(Session::has('success'))
                <div class="alert-msg alert alert-success fade in" style="position: fixed;width:89.11%;z-index: 555">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>Well Success!</strong> {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert-msg alert alert-block alert-danger fade in" style="position: fixed;width:89.11%;z-index: 555">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>Oh Warning!</strong> {{Session::get('error')}}
                </div>
            @endif
            {{--@if($errors->has('status'))--}}
                {{--<div class="alert-msg alert alert-block alert-danger fade in" style="position: fixed;width:89.11%;z-index: 555">--}}
                    {{--<button data-dismiss="alert" class="close close-sm" type="button">--}}
                        {{--<i class="icon-remove"></i>--}}
                    {{--</button>--}}
                    {{--<strong>Oh Warning!</strong> {{$errors->first('error')}}--}}
                {{--</div>--}}
            {{--@endif--}}
            @yield('body')
            <!--footer section start-->
            @include('admin.public.footer')
            <!--footer section end-->
        </section>
    </section>
    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('admin-assets/js/jquery.js') }}"></script>
<script src="{{ asset('admin-assets/js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>
<!--common script for all pages-->
<script src="{{ asset('admin-assets/js/common-scripts.js') }}"></script>
<!-- 自定义js -->
<script src="{{ asset('admin-assets/js/common.js') }}"></script>

<script src="{{ asset('public-static/layer/layer.js') }}"></script>
@yield('script')
</body>
</html>

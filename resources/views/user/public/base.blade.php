<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('member-assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('member-assets/css/bootstrap-responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('member-assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('member-assets/css/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('member-assets/css/fullcalendar.css') }}" />
    @yield('style')
</head>
<body>
    @include('user.public.head')
    <div class="page">
        <div class="page-container">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    @include('user.public.footer')
    @yield('script')
</body>
</html>

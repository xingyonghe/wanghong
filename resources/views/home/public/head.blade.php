<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (auth()->guest())
                    <li><a href="{{ route('auth.login.form') }}">Login</a></li>
                    <li><a href="{{ route('auth.register.form') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a>您好，{{ auth()->user()->nickname }} </a>
                    </li>
                    <li class="dropdown">
                        @if(auth()->user()->type == 1)
                            <a href="{{ route('user.index.index') }}">个人中心</a>
                        @else
                            <a href="{{ route('advert.index.index') }}">个人中心</a>
                        @endif
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('auth.login.logout') }}">退出</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>
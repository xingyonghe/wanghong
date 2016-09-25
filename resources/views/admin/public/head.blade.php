<!--header start-->
<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
    </div>
    <!--logo start-->
    <a href="{{ url('admin/index/index') }}" class="logo">WANG<span>HONG</span></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu" >
        <!-- 顶部菜单 start -->
        <nav class="navbar-menu" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                @foreach($menus['main'] as $menu)
                    <a class="navbar-brand {{ $menu->current }}" href="{{ url($menu->url) }}"><i class="{{ $menu->class }}"></i> {{ $menu->title }}</a>
                @endforeach
            </div>
        </nav>
        <!-- 顶部菜单 end -->
    </div>
    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!--<li>-->
            <!--<input type="text" class="form-control search" placeholder="Search">-->
            <!--</li>-->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle">
                    <span>{{ Auth::guard('admin')->user()->username }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    {{--<li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>--}}
                    {{--<li><a href="#"><i class="icon-cog"></i> Settings</a></li>--}}
                    {{--<li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>--}}
                    <li><a href="{{ url('admin/logout') }}"><i class="icon-key"></i> 退出</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
<!--header end-->
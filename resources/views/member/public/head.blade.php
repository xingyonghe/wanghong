<div id="in-nav">
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="pull-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('auth.login.form') }}">Login</a></li>
                        <li><a href="{{ route('auth.register.form') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="{{ route('user.index.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                您好，{{ Auth::user()->nickname }}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('auth.login.logout') }}">退出</a>
                        </li>
                    @endif
                </ul>
                <a class="navbar-brand" href="{{ route('home.index.index') }}">
                    <h4>风行<strong>网红</strong></h4>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="in-sub-nav">
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul>
                    <li><a href="index.html"  class="active"><i class="batch home"></i><br />个人中心</a></li>
                    <li><span class="label label-important pull-right">08</span><a href="stream.html"><i class="batch stream"></i><br />活动订单</a></li>
                    <li><span class="label label-important pull-right">04</span><a href="messages.html"><i class="batch plane"></i><br />派单大厅</a></li>
                    <li><a href="calendar.html"><i class="batch calendar"></i><br />账户查询</a></li>
                    <li><a href="settings.html"><i class="batch settings"></i><br />资源管理</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
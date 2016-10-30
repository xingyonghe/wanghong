<div id="in-nav">
    <div class="container">
        <div class="row">
            <div class="span12">
                <ul class="pull-right">
                    <li class="dropdown">
                        <a>
                            您好，{{ auth()->user()->nickname }}
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('auth.login.logout') }}">退出</a>
                    </li>
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
                <ul clss="head-nav">
                    <li><a href="{{ route('user.index.index') }}" @if($nav == 1)class="active"@endif><i class="batch home"></i><br />个人中心</a></li>
                    <li><span class="label label-important pull-right" @if($nav == 2)class="active"@endif>08</span><a href="stream.html"><i class="batch stream"></i><br />活动订单</a></li>
                    <li><span class="label label-important pull-right" @if($nav == 3)class="active"@endif>04</span><a href="messages.html"><i class="batch plane"></i><br />派单大厅</a></li>
                    <li><a href="calendar.html"><i class="batch calendar" @if($nav == 4)class="active"@endif></i><br />账户查询</a></li>
                    <li><a href="{{ route('user.star.index') }}" @if($nav == 5)class="active"@endif><i class="batch settings"></i><br />资源管理</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
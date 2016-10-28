@extends('abvert.public.base')
@section('style')
<style type="text/css">
    .col-nav .active{
        background: #EEE;
    }
    .span6 input{
        height: 30px;
        padding: 4px 6px;
        font-size: 14px;
        line-height: 20px;
        color: #555555;
        border-radius: 4px;
    }
</style>
@endsection
@section('script')

@endsection
@section('content')
    <div class="row">
        <div class="span3">
            <h4>个人中心</h4>
            <div class="sidebar">
                <ul class="col-nav span3">
                    <li class="active">
                        <a href="/profile.html"><i class="pull-right icon-user"></i>基本资料</a>
                    </li>
                    <li>
                        <a href="#"> <i class="pull-right icon-cog"></i>我的账户</a>
                    </li>
                    <li>
                        <a href="#"> <i class="pull-right icon-star"></i>修改密码</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h4 class="header">基本资料</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                <div class="control-group">
                    <label for="inputEmail" class="control-label">认证手机： </label>
                    <div class="controls">
                        {{ $user->username }} &nbsp;@if($user->is_auth)已认证@else未认证@endif
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputCurrentPassword" class="control-label">联系人： </label>
                    <div class="controls">
                        {{ $user->nickname }}
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputCurrentPassword" class="control-label">公司名称： </label>
                    <div class="controls">
                        {{ $user->advertiser->company }}
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPassword" class="control-label">QQ号码： </label>
                    <div class="controls">
                        {{ $user->qq }}
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPasswordAgain" class="control-label">微信账号：</label>
                    <div class="controls">
                        {{ $user->weixin }}
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPasswordAgain" class="control-label">我的客服：</label>
                    <div class="controls">
                        {{ $user->custom_name }}
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputPasswordAgain" class="control-label">E-mail：</label>
                    <div class="controls">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <a class="btn"  href="{{ route('abvert.index.edit') }}">修改资料</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
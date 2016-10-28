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
    <script type="text/javascript">
        $(function () {
            //ajax post请求
            $('body').on('click','.ajax-login',function(){
                var form,that,target,query;
                form = $('.data-form');
                target = form.get(0).action;
                that = this;
                query = form.serialize();
                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                $.post(target,query).success(function(data){
                    if (data.status==1){
                        $(that).removeClass('disabled').prop('disabled',false);
                        window.location = data.url;
                    }else{
                        $(that).removeClass('disabled').prop('disabled',false);
                        showError(data.info,data.id,1);
                    }
                });
                return false;
            });
        })
    </script>
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
            <h4 class="header">修改资料</h4>
            <div id="d3" style="width: 100%; margin-top: -30px"></div><br />
            <div class="span6">
                <form class="form-horizontal" action="{{ route('abvert.index.update') }}" metho="POST"/>
                    <div class="control-group">
                        <label for="inputEmail" class="control-label">认证手机： </label>
                        <div class="controls">
                            {{ $user->username }} &nbsp;@if($user->is_auth)已认证@else未认证@endif
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">联系人： </label>
                        <div class="controls">
                            <input id="nickname" type="text" placeholder="请输入联系人名称" value=" {{ $user->nickname }}"/>
                            <strong class="wrong" id="error-nickname"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputCurrentPassword" class="control-label">公司名称： </label>
                        <div class="controls">
                            <input id="company" type="text" placeholder="请输入公司名称" value=" {{ $user->advertiser->company }}"/>
                            <strong class="wrong" id="error-company"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPassword" class="control-label">QQ号码： </label>
                        <div class="controls">
                            <input id="qq" type="text" placeholder="请输入QQ号码" value=" {{ $user->qq }}"/>
                            <strong class="wrong" id="error-qq"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPasswordAgain" class="control-label">微信账号：</label>
                        <div class="controls">
                            <input id="weixin" type="text" placeholder="请输入微信账号" value=" {{ $user->weixin }}"/>
                            <strong class="wrong" id="error-weixin"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="inputPasswordAgain" class="control-label">E-mail：</label>
                        <div class="controls">
                            <input id="email" type="text" placeholder="请输入E-mail" value=" {{ $user->email }}"/>
                            <strong class="wrong" id="error-email"></strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button class="btn ajax-post" type="submit" >保存</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
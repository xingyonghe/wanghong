@extends('home.public.base')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注 册</div>
                <div class="panel-body">
                    <form class="form-horizontal data-form" role="form" method="POST" action="{{ route('home.register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">注册类型</label>
                            <div class="col-md-6">
                                {!! Form::radios("type", [1=>'主播',2=>'广告主'], old('type')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">手机号</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="username" autofocus>
                                <input type="button" name="code" id="get-code" value="获取验证码" style="margin-top: 10px">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">验证码</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="code" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">联系人</label>
                            <div class="col-md-6">
                                <input id="nickname" type="email" class="form-control" name="nickname" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">公司名称</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >
                                <strong style="color: #a94442">请填写公司名称</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">QQ号</label>
                            <div class="col-md-6">
                                <input id="qq" type="text" class="form-control" name="qq" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">微信号</label>
                            <div class="col-md-6">
                                <input id="weixin" type="text" class="form-control" name="weixin" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <input type="checkbox" name="protocol" value="1" >注册协议
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary ajax-post">
                                    注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

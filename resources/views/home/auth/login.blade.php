@extends('home.public.base')
@section('style')

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
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                <div class="panel-body">
                    <form class="form-horizontal data-form" method="POST" action="{{ route('auth.login.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">用户名：</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" autocomplete="off" autofocus>
                                <strong class="wrong" id="error-username"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off">
                                <strong class="wrong" id="error-username"></strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" name="1"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary ajax-login">
                                    登 录
                                </button>

                                <a class="btn btn-link" href="{{ route('auth.password.reset') }}">
                                    忘记密码?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
